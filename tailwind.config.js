/** @type {import('tailwindcss').Config} */
module.exports = {

  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      backgroundColor: {
        'dark': '#1a202c',
      }
    }
  },
  variants: {
    extend: {
      backgroundColor: ['dark'],
    }
  },
  plugins: [],
}
