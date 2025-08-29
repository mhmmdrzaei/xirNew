/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Kumbh Sans', 'sans-serif'],
      },
    },
    screens: {
    'sm': '400px',
    'md': '760px',
    'lg': '1100px',
  }

  },
  plugins: [],
}