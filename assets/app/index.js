import React from "react";
import ReactDom from "react-dom";
import App from "./App";
import { ThemeProvider, createMuiTheme, CssBaseline } from "@material-ui/core";

import { Provider } from "react-redux";

import configureStore from "./store/configureStore";

const store = configureStore();

const darkTheme = createMuiTheme({
  palette: {
    type: "dark",
  },
});

const root = document.getElementById("root");

ReactDom.render(
  <React.StrictMode>
    <Provider store={store}>
      <ThemeProvider theme={darkTheme}>
        <CssBaseline />
        <App />
      </ThemeProvider>
    </Provider>
  </React.StrictMode>,
  root
);
