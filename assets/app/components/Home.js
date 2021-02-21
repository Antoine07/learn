import React from "react";
import {
  Box,
  Container,
  Typography,
  Link,
  Grid,
  Paper,
} from "@material-ui/core";

import { makeStyles } from "@material-ui/core/styles";

import Nav from "./Nav";
import Card from "./Card";
import ChipItem from './ChipItem';

const useStyles = makeStyles((theme) => ({
  root: {
    flexGrow: 1,
  },
  paper: {
    padding: theme.spacing(2),
  },
  marge: {
    margin: 10,
  },
}));

const Copyright = () => {
  return (
    <Typography variant="body2" color="textSecondary" align="center">
      {"Copyright © "}
      <Link color="inherit" href="https://material-ui.com/">
        Your Website
      </Link>{" "}
      {new Date().getFullYear()}
      {"."}
    </Typography>
  );
};

const Home = () => {
  const classes = useStyles();

  return (
    <>
      <Container maxWidth="lg">
        <Nav />
        <Box my={4}>
          <Typography variant="h2" component="h1" gutterBottom>
            Article, formation Web et Data
          </Typography>
        </Box>
        <Grid item xs={12} spacing={1}>
          <Box component="span" m={1}>
          <Typography variant="p" component="h1" gutterBottom>
           Ce site propose des articles sous forme de TP/Exercices pour approfondir ou découvrir des techniques.
          </Typography>
          </Box>
        </Grid>
        <Grid item xs={12} spacing={1}>
          <Box component="span" m={1}>
            <ChipItem />
          </Box>
        </Grid>
        <Grid container spacing={1}>
          {[1, 2, 3, 4, 5, 6].map((i, num) => (
            <Grid item xs={4} key={i}>
              <Paper className={classes.paper} elevation={0}>
                <Card />
              </Paper>
            </Grid>
          ))}
        </Grid>
      </Container>
      <Container maxWidth="md">
        <Copyright />
      </Container>
    </>
  );
};

export default Home;
