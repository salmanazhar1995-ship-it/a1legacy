import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                neutron: {
                    950: '#00050c',
                    900: '#050d18',
                    800: '#0b1625',
                    500: '#2f8fff',
                    300: '#9ecbff',
                },
            },
            fontFamily: {
                sans: ['Geist', ...defaultTheme.fontFamily.sans],
                mono: ['Geist Mono', ...defaultTheme.fontFamily.mono],
            },
            boxShadow: {
                glow: '0 0 40px rgba(47, 143, 255, 0.18)',
            },
        },
    },

    plugins: [forms],
};
