/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'church-blue': '#243f63',
        'church-gold': '#d4af37',
      },
      fontFamily: {
        'lato': ['Lato', 'sans-serif'],
        'questrial': ['Questrial', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
