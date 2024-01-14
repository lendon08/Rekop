export const content = [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
];
export const theme = {
    extend: {},
};
export const plugins = [
    require('flowbite/plugin')({
        charts: true,
    }),
];
