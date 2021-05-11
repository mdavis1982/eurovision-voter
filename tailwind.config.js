const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './resources/views/*.blade.php',
        './resources/views/**/*.blade.php',
        './resources/js/*.{js,vue}',
        './resources/js/**/*.{js,vue}',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
         extend: {},
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}
