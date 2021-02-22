import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import CardMedia from '@material-ui/core/CardMedia';
import Button from '@material-ui/core/Button';
import Typography from '@material-ui/core/Typography';

import ChipItem from './ChipItem';

const useStyles = makeStyles({
  root: {
    maxWidth: 345,
  },
  media: {
    height: 140,
  },
});

export default ({ title, status, price }) => {
  const classes = useStyles();

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
            {title}
          </Typography>
          <Typography variant="body2" color="textSecondary" component="p">
            Lizards are a widespread group of squamate reptiles, with over 6,000 species, ranging
            across all continents except Antarctica.
          </Typography>
          <ChipItem number={ Math.floor(Math.random() * 10) }/>
        </CardContent>
      </CardActionArea>
      <CardActions>
        {status === true && (
          <Button size="small" >
            Gratuit
          </Button>
        )}
        {status === false && (
          <Button variant="contained" size="small" >
            Payant prix : { price} &euro;
          </Button>
        )}
        <Button variant="contained" size="small" color="secondary" disabled={!status}>
          Commencer le cours
        </Button>
      </CardActions>
    </Card>
  );
}
