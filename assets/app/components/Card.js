import React from "react";
import { makeStyles, theme } from "@material-ui/core/styles";
import {
  Button,
  Typography,
  Box,
  CardMedia,
  CardContent,
  CardActions,
  Card,
  CardActionArea,
} from "@material-ui/core";

import { Link } from "react-router-dom";

import { Rating } from "@material-ui/lab";

import ChipItem from "./ChipItem";

const useStyles = makeStyles((theme) => ({
  root: {
    maxWidth: 345,
    [theme.breakpoints.down("md")]: {
      maxWidth: "100%",
      align: "center",
    },
  },
  media: {
    height: 140,
  },
}));

export default ({ id, name, status, taxonomies, authors, content, rate }) => {
  const classes = useStyles();
  const free = taxonomies.filter((tax) => tax.name === "free").length > 0;

  return (
    <Card className={classes.root}>
      <CardActionArea>
        <CardMedia
          className={classes.media}
          image="/static/images/contemplative-reptile.jpg"
          title="Contemplative Reptile"
        />
        <CardContent>
          <Typography gutterBottom variant="h5" component="h2">
            {name}
          </Typography>
          <Typography variant="body2" color="textSecondary" component="p">
            {content} ...
          </Typography>
          <ChipItem taxonomies={taxonomies} />
        </CardContent>
        <CardContent>
          <Rating
            precision={0.5}
            name="read-only"
            value={(rate * 5) / 10}
            readOnly
          />
        </CardContent>
      </CardActionArea>
      <CardActions>
        {free === true && (
          <Button variant="contained" color="secondary" size="small">
            <Link style={{
              color :'#FFF',
              textDecoration: 'none',
              textAlign : 'center'
            }} to={`/lesson/${id}`}>Commencer ...</Link>
          </Button>
        )}
        {free === false && (
          <Button variant="contained" size="small" disabled={true}>
            <small>Réservé aux abonnés</small>
          </Button>
        )}
      </CardActions>
    </Card>
  );
};
