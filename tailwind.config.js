/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily:{
        poppins:  'Poppins',
        figtree: 'Figtree'
      },
      boxShadow:{
        around:'0 0 3px rgba(0, 0, 0, 0.2)',
      }
    },
  },
  plugins: [],
}

