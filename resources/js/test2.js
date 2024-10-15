document.addEventListener("DOMContentLoaded", function () {
    async function checkNumberStatus(number) {
        const cachedStatus = sessionStorage.getItem(`phoneStatus_${number}`);
        if (cachedStatus) {
            return cachedStatus;
        }

        try {
            const response = await fetch(
                `https://koala-sincere-quail.ngrok-free.app/api/test-phone-number?phoneNumber=${number}`
            );

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            const phoneStatus = data.phoneStatus;

            sessionStorage.setItem(`phoneStatus_${number}`, phoneStatus);
            return phoneStatus;
        } catch (error) {
            console.error("Error fetching phone number status:", error);
            return "error";
        }
    }

    async function getDynamicNumber() {
        const urlParams = new URLSearchParams(window.location.search);
        const source = urlParams.get("utm_source");
        const sourceNumberPools = [
            {
                referrer_tracking_source: "google",
                swap_targets: "1234567890",
                number: ["19182764831", "19182576033", "13463586844"],
            },
            {
                referrer_tracking_source: "facebook",
                swap_targets: "1234567890",
                number: ["15392001096", "555-222-0002", "555-222-0003"],
            },
            {
                referrer_tracking_source: "email",
                swap_targets: "12345640727",
                number: ["17135640727", "555-333-0002", "555-333-0003"],
            },
        ];

        const pool = sourceNumberPools.find(
            (item) => item.referrer_tracking_source === source
        );

        if (pool) {
            for (const candidateNumber of pool.number) {
                const status = await checkNumberStatus(candidateNumber);
                if (status === "available") {
                    return candidateNumber;
                }
            }
        }

        return "555-000-0000";
    }

    async function checkAndUpdatePhoneNumber() {
        const urlParams = new URLSearchParams(window.location.search);
        const source = urlParams.get("utm_source");
        const sourceNumberPools = {
            google: ["19182764831", "19182576033", "13463586844"],
            facebook: ["15392001096", "555-222-0002", "555-222-0003"],
            email: ["17135640727", "555-333-0002", "555-333-0003"],
        };

        if (sourceNumberPools[source]) {
            const pool = sourceNumberPools[source];
            pool.forEach((number) => {
                sessionStorage.removeItem(`phoneStatus_${number}`);
            });
        }

        const phoneNumber = await getDynamicNumber();

        document.querySelectorAll(".dynamic-number").forEach((element) => {
            const originalFormat = element.textContent;

            const formattedNumber = formatNumber(originalFormat, phoneNumber);

            element.textContent = formattedNumber;
            element.setAttribute("href", `tel:${phoneNumber}`);
        });
    }

    function formatNumber(originalFormat, newNumber) {
        return originalFormat.replace(
            /\d/g,
            (digit, index) => newNumber[index] || digit
        );
    }

    function schedulePhoneNumberCheck() {
        checkAndUpdatePhoneNumber();

        setInterval(() => {
            checkAndUpdatePhoneNumber();
        }, 30 * 60 * 1000);
    }

    let isSending = false;

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

    // Start scheduling phone number checks
    schedulePhoneNumberCheck();
});
