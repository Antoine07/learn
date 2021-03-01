import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { getApiLessons } from "../store/actions/actions-types";

import { Box, Typography, Grid, Paper, Button, TextField } from "@material-ui/core";
import { Link } from "react-router-dom";

import { makeStyles } from "@material-ui/core/styles";

import Card from "./Card";
import ChipItem from "./ChipItem";
import Copyright from "./Copyright";
import Filter from "./Filter";

const useStyles = makeStyles((theme) => ({
  root: {
    flexGrow: 1,
  },
  paper: {
    padding: theme.spacing(2),
    margin: theme.spacing(1),
  },
  marge: {
    margin: 10,
  },
  btn: {
    marginRight: 5,
  },
}));

const Home = () => {
  const classes = useStyles();
  const dispatch = useDispatch();

  const {
    lesson: { isLoading, best, search },
  } = useSelector((state) => {
    return { lesson: state.lesson };
  });

  useEffect(() => {
    if (best.length === 0) dispatch(getApiLessons());
  }, []);

  const showSearch = () => {
    if (search.length === 0) return false;

    return search.map((course, i) => (
      <Grid item md={4} xs={12} key={i}>
        <Paper className={classes.paper} elevation={0}>
          <Card {...course} />
        </Paper>
      </Grid>
    ));
  };

  const showBest = () => {
    if (isLoading === false)
      return best.map((course, i) => (
        <Grid item md={4} xs={12} key={i}>
          <Paper className={classes.paper} elevation={0}>
            <Card {...course} />
          </Paper>
        </Grid>
      ));
  };

  return (
    <div className={classes.root}>
      <Grid container>
        <Grid item md={10}>
          <Box my={4} align="left">
            <Typography variant="h1" component="h2" gutterBottom>
              Coder !
            </Typography>
          </Box>
        </Grid>
        <Grid item md={2}>
          <Box my={4} align="rigth">
            <Typography variant="p" component="p" gutterBottom>
              Déjà inscrit ?
          </Typography>
            <form className={classes.root} noValidate autoComplete="off">
              <div>
                <TextField id="standard-basic" label="Standard" />
              </div>
              <div>
                <TextField id="standard-basic" label="Standard" />
              </div>
              <Button  color="primary">
                Start coding !
              </Button>
            </form>
            <Button color="inherit">
              <Link to="/login" style={{ color: 'white', textDecoration: 'none' }} >Login/Inscription</Link>
            </Button>
          </Box>
        </Grid>
        <Grid item md={6}>
          <Typography component="h2" gutterBottom>
            Pour accéder aux contenus des cours/exercices vous devez vous
            abonner.
              <br />
            <small>
              Cependant certains cours/exercices sont parfois libres d'accès,
              vérifiez !
              </small>
            <p>
              <Button variant="contained" color="primary">
                voir le Catalogue
                </Button>
            </p>
          </Typography>
        </Grid>
        <Grid item md={12}>
          <Filter />
        </Grid>
        <Grid md={12} item>
          <Box component="span" m={1}>
            <ChipItem
              titles={[
                "Le mieux noté",
                "le plus technique",
                "Data uniquement",
                "Le dernier cours",
                "Le moins cher",
                "Les cours gratuits",
              ]}
              classic={false}
            />
          </Box>
        </Grid>
        {search.length > 0 ? showSearch() : showBest()}
      </Grid>
      <Grid container>
        <Copyright />
      </Grid>
    </div>
  );
};

export default Home;
