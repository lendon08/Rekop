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
    function detectSource() {
        const referrer = document.referrer;
        const urlParams = new URLSearchParams(window.location.search);
        const utmSource = urlParams.get("utm_source");

        const sources = [
            { name: "Google", pattern: /google\.com/ },
            { name: "Facebook", pattern: /facebook\.com/ },
            { name: "Twitter", pattern: /twitter\.com/ },
            { name: "Bing", pattern: /bing\.com/ },
            { name: "DuckDuckGo", pattern: /duckduckgo\.com/ },
            { name: "Instagram", pattern: /instagram\.com/ },
            { name: "Nextdoor", pattern: /nextdoor\.com/ },
            { name: "LinkedIn", pattern: /linkedin\.com/ },
            { name: "TikTok", pattern: /tiktok\.com/ },
            { name: "Reddit", pattern: /reddit\.com/ },
            { name: "YouTube", pattern: /youtube\.com/ },
            { name: "Pinterest", pattern: /pinterest\.com/ },
        ];

        // Check for UTM source
        if (utmSource) {
            console.log(
                "Traffic source detected from UTM parameter:",
                utmSource
            );
            return utmSource;
        }

        // Check referrer source
        for (let source of sources) {
            if (source.pattern.test(referrer)) {
                console.log(
                    "Traffic source detected from referrer:",
                    source.name
                );
                return source.name;
            }
        }

        // Default if no source is detected
        console.log("Unknown traffic source");
        return "Unknown";
    }

    // Call the source detection function
    const trafficSource = detectSource();
    console.log("Traffic source:", trafficSource);

    // Traverse and replace numbers
    traverseAndReplace(document.body);
})([
    ["1112223333", "4445556666"],
    ["2223334444", "1234567890"],
]);
