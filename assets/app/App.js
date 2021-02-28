import React from "react";
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";

import { Container, Grid } from "@material-ui/core";

import Home from "./components/Home";
import Nav from './components/Nav';
import GlobalStyle from "./Styles/Global";
import Lesson from "./components/Lesson";
import Inscription from './components/Inscription';

const App = () => {
  return (
    <Router>
      <Container maxWidth="md">
        <GlobalStyle />
        <Grid container spacing={2}>
          <Grid item md={12}>
            <Nav />
          </Grid>
        </Grid>
        <Switch>
          <Route exact path="/" component={ ()  => <Home/> }/>
          <Route exact path="/lesson/:id" component={() => <Lesson />} />
          <Route exact path="/login" component={() => <Inscription />} />

        </Switch>
      </Container>
    </Router>
  );
};

export default App;
