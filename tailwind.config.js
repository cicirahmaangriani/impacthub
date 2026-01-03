import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/views/**/*.php',
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
    './app/View/Components/**/*.php',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },

      colors: {
        ocean: {
          50: '#f3f8fb',
          100: '#d2dbeb',
          200: '#c3d2e3',
          300: '#94a2bf',
          400: '#6a90b4',
          500: '#00385a',
          600: '#00314e',
          700: '#002a42',
          800: '#011f33',
          900: '#01162b',
        },
      },
    },
  },

  // OPTIONAL: aktifkan kalau kamu pakai class dinamis
  // safelist: [
  //   { pattern: /(bg|text|border|from|to|via)-ocean-(50|100|200|300|400|500|600|700|800|900)/ },
  // ],

  plugins: [forms],
}
