import React from "react";
import ReactDom from "react-dom";
import App from "./App";

import { ThemeProvider, createMuiTheme, CssBaseline } from "@material-ui/core";

const darkTheme = createMuiTheme({
    palette: {
      type: 'dark',
    },
  });

ReactDom.render(
  <ThemeProvider theme={darkTheme}>
      <CssBaseline />
    <App />
  </ThemeProvider>,
  document.getElementById("root")
);
