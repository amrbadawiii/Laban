import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                cyan: {
                    100: '#e0f7fa', // Light cyan
                    200: '#80deea',
                    300: '#4dd0e1',
                    400: '#26c6da',
                    500: '#00bcd4', // Base cyan
                    600: '#00acc1',
                    700: '#0097a7',
                    800: '#00838f',
                    900: '#006064', // Dark cyan
                },
                indigo: {
                    100: '#c3dafe',
                    200: '#a3bffa',
                    300: '#6f84f4',
                    400: '#3b5bff',
                    500: '#1d43ff', // Base indigo
                    600: '#1839e6',
                    700: '#132db8',
                    800: '#0f2590',
                    900: '#0a1a6d', // Dark indigo
                },
                amber: {
                    100: '#fff8e1',
                    200: '#ffecb3',
                    300: '#ffe082',
                    400: '#ffd54f',
                    500: '#ffca28', // Base amber
                    600: '#ffb300',
                    700: '#ffa000',
                    800: '#ff8f00',
                    900: '#ff6f00', // Dark amber
                },
                teal: {
                    100: '#b2dfdb',
                    200: '#80cbc4',
                    300: '#4db6ac',
                    400: '#26a69a',
                    500: '#009688', // Base teal
                    600: '#00897b',
                    700: '#00796b',
                    800: '#00695c',
                    900: '#004d40', // Dark teal
                },
                purple: {
                    100: '#f3e5f5',
                    200: '#e1bee7',
                    300: '#d1a7d7',
                    400: '#ba68c8',
                    500: '#9c27b0', // Base purple
                    600: '#8e24aa',
                    700: '#7b1fa2',
                    800: '#6a1b9a',
                    900: '#4a148c', // Dark purple
                },
            },
        },
    },
    plugins: [],
};
