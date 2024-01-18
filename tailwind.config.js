/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php}",
    "./src/**/*"
    //"./src/after_auth/*.{html,js,php}",
    //"./src/before_auth/*.{html,js,php}"
  ],
  theme: {
    extend: {
      height: {
        '10v': '10vh',
        '20v': '20vh',
        '30v': '30vh',
        '40v': '40vh',
        '50v': '50vh',
        '60v': '60vh',
        '70v': '70vh',
        '80v': '80vh',
        '90v': '90vh',
        '100v': '100vh',
			},
      colors: {
        'violet-d': {
          100: '#4F407A', //text-bg, button-bg
          200: '#624DE3', //icon violet on table
          300: '#26264F', //table bg2
          400: '#1D1E42', //table bg1
          500: '#141432', //card-bg
          600: '#1C1F34', //sidebar bg
          700: '#040018', //for main bg
        },
        'violet-pastel': '#A598F6',
        'black-01': '#0B0B0B', // header bg
        'yellow-l': '#FFDD77',
        'yellow-d': '#EFC135',
        'gray-1': '#3D3D3D', //notif gray
        'green-d': '#035B36',
        'red-d': '#8B0021',
        'white-01': '#FCF8F8', //for white text
        'blue-d': '#31507F', //dark blue text
      },
      fontFamily: {
        'pop': ['Poppins']
      },
      width: {
        '10v': '10vw',
        '20v': '20vw',
        '30v': '30vw',
        '40v': '40vw',
        '50v': '50vw',
        '60v': '60vw',
        '70v': '70vw',
        '80v': '80vw',
        '90v': '90vw',
        '100v': '100vw',
			}
    },
  },
  plugins: [],
}

