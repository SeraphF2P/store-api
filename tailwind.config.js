/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      screens: {
        min: "320px",
        xsm: "420px",
        xs: "576px",
      },
      gridAutoColumns: {
        fluid: "repeat(auto-fit,minmax(0,1fr))",
      },
      gridAutoRows: {
        fluid: "repeat(auto-fit,minmax(0,1fr))",
      },
      animation: {
        toast: "toast 5s ease-in-out forwards",
      },
      keyframes: {
        toast: {
          "0%": {
            translate:
              "0 0",
          },
          "10%": {
            translate:
              "-1000px 0",
          },
          "90%": {
            translate:
              "-1000px 0",
          },
          "100%": {
            translate:
              "0 0",
          },
        },
      },
    },
  },
  plugins: [
    require("tailwindcss-brand-colors"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/forms"),
  ],
}


