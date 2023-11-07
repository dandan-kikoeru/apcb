import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
  content: ["./resources/**/*.blade.php"],
  theme: {
    extend: {
      boxShadow: {
        center: "0px 0px 16px 4px rgba(0,0,0,0.2)",
      },
    },
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: [
      {
        facebook: {
          primary: "#1877f2",
          secondary: "#42b72a",
          accent: "#3e4042",
          neutral: "#242526",
          "base-100": "#18191a",
          info: "#3abff8",
          success: "#36d399",
          warning: "#fbbd23",
          error: "#f87272",
        },
      },
    ],
  },
};
