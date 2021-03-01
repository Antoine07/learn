import React from "react";
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";

import { Container, Grid } from "@material-ui/core";

import Home from "./components/Home";
import Nav from './components/Nav';
import GlobalStyle from "./Styles/Global";
import Lesson from "./components/Lesson";
import Inscription from './components/Inscription';

import { ThemeProvider, createMuiTheme } from '@material-ui/core/styles';

const theme = createMuiTheme({
  typography: {
    fontFamily: [
      'Chilanka',
      'cursive',
    ].join(','),
  },});

const App = () => {
  return (
    <Router>
      <ThemeProvider theme={theme}>
      <GlobalStyle />
      <Grid container spacing={2}>
          <Grid item md={12}>
            <Nav />
          </Grid>
        </Grid>
      <Container maxWidth="md">
        <Switch>
          <Route exact path="/" component={() => <Home />} />
          <Route exact path="/lesson/:id" component={() => <Lesson />} />
          <Route exact path="/login" component={() => <Inscription />} />

        </Switch>
      </Container>
      </ThemeProvider>
    </Router>
  );
};

export default App;
