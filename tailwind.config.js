const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: theme => ({
                'background': "url('https://scdrn.nl/images/bg-body.png')",
            }),
            minWidth: {
                'input': '250px',
            },
            maxWidth: {
                'input': '350px',
                'filterName': '250px',
                'filterSpeltak': '175px',
            },
            width: {
                'filterName': '250px',
                'filterSpeltak': '175px',
            }
        },
        minHeight: {
            '0': '0',
            '1/6': '16.666667%',
            '1/5': '20%',
            '1/4': '25%',
            '1/2': '50%',
            '3/4': '75%',
            '4/5': '80%',
            '5/6': '83.333333%',
            'full': '100%',
            'screen': '100vh',
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
