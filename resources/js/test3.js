document.addEventListener("DOMContentLoaded", function () {
    // "use strict";

    async function checkNumberStatus(number) {
        try {
            const response = await fetch(
                `https://koala-sincere-quail.ngrok-free.app/api/test-phone-number?phoneNumber=${number}`
            );

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            return data.phoneStatus;
        } catch (error) {
            console.error("Error fetching phone number status:", error);
            return "error";
        }
    }

    async function getDynamicNumber() {
        const urlParams = new URLSearchParams(window.location.search);
        const source = urlParams.get("utm_source");
        const sourceNumberPools = {
            google: ["19182764831", "19182576033", "13463586844"],
            facebook: ["15392001096", "555-222-0002", "555-222-0003"],
            email: ["17135640727", "555-333-0002", "555-333-0003"],
        };

        const lastIndexKey = `lastIndex_${source}`;
        const lastIndex = parseInt(localStorage.getItem(lastIndexKey)) || 0;

        if (sourceNumberPools[source]) {
            const pool = sourceNumberPools[source];
            for (let i = 0; i < pool.length; i++) {
                const candidateNumber = pool[(lastIndex + i) % pool.length];
                if (
                    (await checkNumberStatus(candidateNumber)) === "available"
                ) {
                    localStorage.setItem(
                        lastIndexKey,
                        (lastIndex + i + 1) % pool.length
                    );
                    return candidateNumber;
                }
            }
        }

        return "555-000-0000";
    }

    async function sendTrafficData() {
        if (isSending) return;
        isSending = true;

        const urlParams = new URLSearchParams(window.location.search);
        const csrfToken =
            document.querySelector('meta[name="csrf-token"]')?.content || null;

        const data = {
            source: getTrafficSource(),
            medium: urlParams.get("utm_medium") || "unknown",
            campaign: urlParams.get("utm_campaign") || "unknown",
            term: urlParams.get("utm_term") || "unknown",
            content: urlParams.get("utm_content") || "unknown",
            url: window.location.host,
            referrer: document.referrer,
        };

        const headers = { "Content-Type": "application/json" };
        if (csrfToken) headers["X-CSRF-TOKEN"] = csrfToken;

        try {
            const response = await fetch(
                "https://koala-sincere-quail.ngrok-free.app/api/traffic-source",
                {
                    method: "POST",
                    headers: headers,
                    body: JSON.stringify(data),
                }
            );

            const responseData = response.ok
                ? await (response.headers
                      .get("content-type")
                      ?.includes("application/json")
                      ? response.json()
                      : response.text())
                : "Error: Unable to send traffic data";

            console.log("Traffic source data sent successfully:", responseData);
        } catch (error) {
            console.error("Error sending traffic source data:", error);
        } finally {
            isSending = false;
        }
    }

    function getTrafficSource() {
        return (
            new URLSearchParams(window.location.search).get("utm_source") ||
            "unknown"
        );
    }

    function getLocalData(key) {
        return localStorage.getItem(key);
    }

    function setLocalData(key, value) {
        localStorage.setItem(key, value);
    }

    function createLocalData() {
        const data = getLocalData("isoncall");
        if (!data) {
            setLocalData("isoncall", "done");
        }
        return data;
    }

    // if (!createLocalData()) {
    //     sendTrafficData();
    // }
    (async function () {
        const phoneNumber = await getDynamicNumber();
        document.querySelectorAll(".dynamic-number").forEach((element) => {
            element.textContent = phoneNumber;
            element.setAttribute("href", `tel:${phoneNumber}`);
        });
    })();
});
