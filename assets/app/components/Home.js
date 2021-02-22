import React from "react";
import {
  Box,
  Container,
  Typography,
  Link,
  Grid,
  Paper,
  Button
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
  btn :{
    marginRight : 5
  }
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
          <Box component="span" m={1} align="center">
            <Typography variant="p" component="h2" gutterBottom>
              Ce site propose des articles sous forme de TP/Exercices pour approfondir et/ou découvrir des techniques.
              <br />
              <small>Vous pouvez acheter un cours ou vous abonnez. Certains cours sont gratuits afin que vous puissiez découvrir les supports.</small>
              <p>
                <Button variant="contained" className={classes.btn} >Start subscription</Button>
                <Button variant="contained" color="primary">
                  voir le Catalogue
              </Button>
              </p>
            </Typography>
          </Box>
        </Grid>
        <Grid item xs={12} spacing={1}>
          <Box component="span" m={1}>
            <ChipItem titles={[
              'Le mieux noté', 'le plus technique', 'Data uniquement',
              'Le dernier cours', 'Le moins cher', 'Les cours gratuits'
              ]}
              classic={false}
             />
          </Box>
        </Grid>
        <Grid container spacing={1}>
          {[
            {title : 'Data ACP', price : 20, status :false },  
            {title : 'Découvrir Python', price : 0, status : true }, 
            {title : 'Observable RxJS', price : 10, status : false},
            {title : 'DataViz', price : 30, status : false},
            {title : 'Explorer et nettoyer les données (Data)', price : 10, status : false},
            { title : 'Symfony extends Dans Doctrine', price : 50, status : false}
          ].map((course, i) => (
            <Grid item xs={4} key={i}>
              <Paper className={classes.paper} elevation={0}>
                <Card 
                 { ...course }
                />
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
