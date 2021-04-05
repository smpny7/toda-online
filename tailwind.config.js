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
                themeColor: '#FF9113'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans]
            },
            fontSize: {
                'xxs': '.5rem'
            },
            scale: {
                102: '1.02'
            },
            screens: {
                '2xl': '1536px',
            }
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
