const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito',
                    ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive',
            'hover',
            'focus',
            'disabled'],
        extend: {
            backgroundColor: ['active']
        }
    },

    darkMode: 'media',

    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/line-clamp'),
    ],
};
