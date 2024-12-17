<main class="px-2 space-y-4 overflow-x-hidden">

    <x-organisms.settings-nav></x-organisms.settings-nav>

    <div class="p-6 w-full text-2xl font-bold sm:p-6">
        JavaScript Snippet
    </div>

    <div class="bg-white block sm:flex border-b border-gray-200 p-4">
        <section class="w-3/5 flex flex-col bg-white px-4 py-4 space-y-4">
            <h2 class="text-lg font-semibold text-gray-800">Dynamic Number Insertion</h2>
            <p class="mt-2 text-sm text-gray-600">
                Insert this code snippet immediately before the <code>&lt;/body&gt;</code> tag on every page of your website. It must be included on every landing page and every page containing a phone number.
            </p>

            <div class="mt-4 bg-gray-100 p-4 rounded-lg">
                <code id="codeBlock" class="text-gray-800">
                {{$link}}
                </code>
            </div>

            <div class="mt-6 flex space-x-4">
                <button onclick="copyToClipboard()"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                >Copy</button>

                <button class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-1">
                Send By Email
                </button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-1">
                Advanced Settings
                </button>
            </div>
        </section>
        <section class="w-2/5 bg-gray-100 px-4 py-4">
            <div class='flex flex-col space-y-4'>
                <span class="font-semibold text-sm">JavaScript Snippet Documentation</span>
                <div class="text-justify">For more detailed setup information, please visit our support article.</div>
                <div> <a href="#" target="_blank" rel="noopener noreferrer">Visit JavaScript Snippet Article</a></div>
            </div>
        </section>
    </div>
    <script>
        // Copy the content to clipboard using JavaScript
        function copyToClipboard() {

            var range = document.createRange();
            range.selectNode(document.getElementById("codeBlock"));
            window.getSelection().removeAllRanges(); // clear current selection
            window.getSelection().addRange(range); // to select text
            document.execCommand("copy");
            window.getSelection().removeAllRanges();// to deselect
        }

    </script>
</main>
