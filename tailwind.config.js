const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                themeColor: '#FF9113',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'xxs': '.5rem',
            },
            height: {
                120: '30rem',
                150: '37.5rem',
            },
            scale: {
                102: '1.02',
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        extend: {
            scale: ['hover'],
        },
    },

    plugins: [require('@tailwindcss/ui')],
};
