import React from "react";
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";

import { Container, Grid } from "@material-ui/core";

import Home from "./components/Home";
import Nav from './components/Nav';
import GlobalStyle from "./Styles/Global";
import Lesson from "./components/Lesson";

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
          <Route exact path="/" component={ ()  => <Lesson/> }/>
          <Route exact path="/lesson/:id" component={() => <Lesson />} />
        </Switch>
      </Container>
    </Router>
  );
};

export default App;
