document.addEventListener("DOMContentLoaded", function () {
    // Number pools configuration
    const numberPools = [
        {
            trackingSource: "Landing Page",
            swapTargets: "1234567890",
            numbers: ["19182764831", "19182576033", "13463586844"],
            url: "http://www.nienow.biz/landing",
            searchEngine: null,
            traffic: null,
        },
        {
            trackingSource: "Landing Page",
            swapTargets: "1234567890",
            numbers: ["19182764831", "19182576033", "555-222-0003"],
            url: "http://www.nienow.biz/landing2",
            searchEngine: null,
            traffic: null,
        },
        {
            trackingSource: "Search",
            swapTargets: "1234567890",
            numbers: ["15392001096", "555-222-0002", "555-222-0003"],
            url: null,
            searchEngine: "google",
            traffic: "organic",
        },
        {
            trackingSource: "Search",
            swapTargets: "12345640727",
            numbers: ["17135640727", "555-333-0002", "555-333-0003"],
            url: null,
            searchEngine: "google",
            traffic: "paid",
        },
        {
            trackingSource: "Search",
            swapTargets: "12345640727",
            numbers: ["17135640727", "555-333-0002", "555-333-0003"],
            url: null,
            searchEngine: "bing",
            traffic: "all",
        },
        {
            trackingSource: "All Visitors",
            swapTargets: "12345640727",
            numbers: ["17135640727", "555-333-0002", "555-333-0003"],
            url: null,
            searchEngine: null,
            traffic: null,
        },
    ];

    // Function to fetch and cache the status of a phone number
    async function fetchAndCachePhoneNumberStatus(phoneNumber) {
        const cachedStatus = sessionStorage.getItem(
            `phoneStatus_${phoneNumber}`
        );
        if (cachedStatus) {
            return cachedStatus;
        }

        try {
            const response = await fetch(
                `https://koala-sincere-quail.ngrok-free.app/api/test-phone-number?phoneNumber=${phoneNumber}`
            );

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            const phoneStatus = data.phoneStatus;

            sessionStorage.setItem(`phoneStatus_${phoneNumber}`, phoneStatus);
            return phoneStatus;
        } catch (error) {
            console.error("Error fetching phone number status:", error);
            return "error";
        }
    }

    // Function to determine the appropriate phone number based on the configuration
    async function determinePhoneNumber() {
        const urlParams = new URLSearchParams(window.location.search);
        const source = urlParams.get("utm_source");
        const medium = urlParams.get("utm_medium") || "organic";
        const currentUrl = window.location.href;

        // Find the matching pool based on the source, medium, and URL
        const pool = numberPools.find((item) => {
            return (
                (item.trackingSource === "Landing Page" &&
                    currentUrl.includes(item.url)) ||
                (item.trackingSource === "Search" &&
                    item.searchEngine === source &&
                    (item.traffic === medium || item.traffic === "all")) ||
                item.trackingSource === "All Visitors"
            );
        });

        // If a matching pool is found, check the availability of numbers in the pool
        if (pool) {
            for (const candidateNumber of pool.numbers) {
                const status = await fetchAndCachePhoneNumberStatus(
                    candidateNumber
                );
                if (status === "available") {
                    return candidateNumber;
                }
            }
        }

        return null;
    }

    // Function to find and update elements with the appropriate dynamic phone number
    async function updateDynamicPhoneNumbers() {
        const dynamicPhoneNumber = await determinePhoneNumber();
        if (dynamicPhoneNumber !== null) {
            // Find all elements with the class ".dynamic-number" and update them with the formatted phone number
            document.querySelectorAll(".dynamic-number").forEach((element) => {
                const originalFormat = element.textContent;
                const formattedNumber = formatPhoneNumber(
                    originalFormat,
                    dynamicPhoneNumber
                );
                element.textContent = formattedNumber;
                element.setAttribute("href", `tel:${dynamicPhoneNumber}`);
            });
        } else {
            console.warn(
                "No available phone number found for the current configuration."
            );
        }
    }

    // Function to format the phone number based on the original format
    function formatPhoneNumber(originalFormat, newNumber) {
        return originalFormat.replace(
            /\d/g,
            (digit, index) => newNumber[index] || digit
        );
    }

    // Function to schedule phone number updates at intervals
    function startPhoneNumberUpdateSchedule() {
        updateDynamicPhoneNumbers();
        setInterval(() => {
            updateDynamicPhoneNumbers();
        }, 30 * 60 * 1000); // Update every 30 minutes
    }

    let isTrafficDataSending = false;

    // Function to send traffic data asynchronously
    async function sendTrafficData() {
        if (isTrafficDataSending) return;
        isTrafficDataSending = true;

        const urlParams = new URLSearchParams(window.location.search);
        const csrfToken =
            document.querySelector('meta[name="csrf-token"]')?.content || null;

        const trafficData = {
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
                    body: JSON.stringify(trafficData),
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
            isTrafficDataSending = false;
        }
    }

    // Function to get traffic source from URL parameters
    function getTrafficSource() {
        return (
            new URLSearchParams(window.location.search).get("utm_source") ||
            "unknown"
        );
    }

    // Start phone number update schedule
    startPhoneNumberUpdateSchedule();
});
