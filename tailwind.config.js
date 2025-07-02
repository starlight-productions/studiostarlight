// Tailwind config placeholder
module.exports = {
    content: [
      "./app/Views/**/*.php",
      "./public/**/*.php"
    ],
    darkMode: 'class',
    theme: {
      extend: {
        colors: {
          moss:       '#5d7754',
          parchment:  '#f5f0e8',
          vintageRed: '#8d3f3f',
          mutedBlue:  '#46647a'
        },
        fontFamily: {
          serif:   ['"Libre Baskerville"', 'serif'],
          rounded: ['"Nunito"', 'sans-serif']
        }
      }
    },
    plugins: [],
  }
  