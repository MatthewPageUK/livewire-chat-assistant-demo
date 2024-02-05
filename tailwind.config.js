const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      animation: {
        'spin-slow': 'spin 3s linear infinite',
      },
      fontFamily: {
        sans: ['Almarai', ...defaultTheme.fontFamily.sans],
        atma: ['Atma'],
      },
      colors: {
        primary: colors.zinc,
        secondary: colors.amber,
        highlight: colors.green,
      },
    },
  },
  plugins: [],
}

