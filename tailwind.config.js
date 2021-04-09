const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php'
    ],

    theme: {
        extend: {
            colors: {
                themeColor: '#FF9113'
            },
            fontFamily: {
                sans: ['Nunito', '"M PLUS Rounded 1c"', ...defaultTheme.fontFamily.sans]
            },
            fontSize: {
                'xxs': '.5rem'
            },
            scale: {
                102: '1.02'
            },
            screens: {
                '2xl': '1536px'
            }
        }
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        extend: {
            scale: ['hover']
        }
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('@tailwindcss/custom-forms'),
        function ({addUtilities}) {
            const newUtilities = {
                ".text-shadow": {
                    textShadow: "0px 0px 2px #00000055"
                },
                ".text-shadow-md": {
                    textShadow: "0px 0px 4px #00000055"
                },
                ".text-shadow-lg": {
                    textShadow: "0px 0px 6px #00000055"
                },
                ".text-shadow-xl": {
                    textShadow: "0px 0px 8px #00000055"
                },
                ".text-shadow-2xl": {
                    textShadow: "0px 0px 10px #00000055"
                },
                ".text-shadow-none": {
                    textShadow: "none"
                }
            }
            addUtilities(newUtilities)
        }
    ]
}
