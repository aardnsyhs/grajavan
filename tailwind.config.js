/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {},
    },

    plugins: [require("preline/plugin")],
};
