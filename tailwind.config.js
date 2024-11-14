const plugin = require("tailwindcss/plugin");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require("flowbite/plugin"),
        plugin(function ({ addVariant }) {
            addVariant("progress-unfilled", ["&::-webkit-progress-bar", "&"]);
            addVariant("progress-filled", [
                "&::-webkit-progress-value",
                "&::-moz-progress-bar",
                "&",
            ]);
        }),
    ],
};
