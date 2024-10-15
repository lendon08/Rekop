(function (numberPairs) {
    "use strict";

    const phoneRegex = /(\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4})/g;

    const replaceDigits = (match, newDigits) => {
        let digitIndex = 0;
        return match.replace(/\d/g, () => newDigits[digitIndex++]);
    };

    function traverseAndReplace(node) {
        if (node.nodeType === Node.TEXT_NODE) {
            node.textContent = node.textContent.replace(phoneRegex, (match) => {
                const matchDigits = match.replace(/\D/g, "");
                for (let [original, newNumber] of numberPairs) {
                    const originalDigits = original.replace(/\D/g, "");
                    const newDigits = newNumber.replace(/\D/g, "");
                    if (matchDigits === originalDigits) {
                        return replaceDigits(match, newDigits);
                    }
                }
                return match;
            });
        } else {
            for (let child of node.childNodes) {
                traverseAndReplace(child);
            }
        }
    }

    // Function to detect traffic source

    // Function to send traffic source data to Laravel without redirection
    function sendTrafficData() {
        const currentUrl = window.location.host;
        const referrer = document.referrer;

        const urlParams = new URLSearchParams(window.location.search);
        const utmSource = urlParams.get("utm_source") || "unknown";
        const utmmedium = urlParams.get("utm_medium") || "unknown";
        const utmcampaign = urlParams.get("utm_campaign") || "unknown";
        const utmterm = urlParams.get("utm_term") || "unknown";
        const utmcontent = urlParams.get("utm_content") || "unknown";

        // Try to get CSRF token, but don't fail if it's not available
        const csrfTokenElement = document.querySelector(
            'meta[name="csrf-token"]'
        );
        const csrfToken = csrfTokenElement
            ? csrfTokenElement.getAttribute("content")
            : null;

        // Prepare the data to be sent
        const data = {
            source: utmSource,
            medium: utmmedium,
            campaign: utmcampaign,
            term: utmterm,
            content: utmcontent,
            url: currentUrl,
            referrer: referrer,
        };

        // Log the data to view it in the browser console
        console.log("Data to be sent to Laravel:", data);

        // Prepare headers for fetch request
        const headers = {
            "Content-Type": "application/json",
        };
        if (csrfToken) {
            headers["X-CSRF-TOKEN"] = csrfToken; // Add CSRF token if available
        }

        // Send the traffic source data to Laravel using fetch (AJAX)
        fetch("https://koala-sincere-quail.ngrok-free.app/api/traffic-source", {
            method: "POST",
            headers: headers,
            body: JSON.stringify(data),
        })
            .then((response) => {
                // Check if the response is in JSON format
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.includes("application/json")) {
                    return response.json(); // Parse JSON if the response is in JSON format
                } else {
                    return response.text(); // Otherwise, return text (or HTML)
                }
            })
            .then((data) => {
                console.log("Traffic source data sent successfully:", data);
            })
            .catch((error) => {
                console.error("Error sending traffic source data:", error);
            });
    }

    // Call the function to send traffic data without redirection
    sendTrafficData();

    // Traverse and replace numbers
    traverseAndReplace(document.body);
})([
    ["1112223333", "4445556666"],
    ["1112223333", "1234567890"],
]);
