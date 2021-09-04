const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    mode: 'jit',
    purge: {
        content: [
            './resources/**/*.antlers.html',
            './resources/**/*.blade.php',
            './content/**/*.md'
        ]
    },
    important: true,
    theme: {
        fontFamily: {
            sans: ['Inter', ...defaultTheme.fontFamily.sans],
        },
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        li: {
                            marginBottom: '0',
                            marginTop: '0',
                            '> p': {
                                marginTop: '0 !important',
                                marginBottom: '0 !important'
                            }
                        }
                    },
                },
            }),

        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
