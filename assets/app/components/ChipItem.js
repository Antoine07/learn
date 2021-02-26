import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Avatar from '@material-ui/core/Avatar';
import Chip from '@material-ui/core/Chip';

const useStyles = makeStyles((theme) => ({
  root: {
    display: 'flex',
    justifyContent: 'center',
    flexWrap: 'wrap',
    '& > *': {
      margin: theme.spacing(0.5),
    },
  },
}));

const handleClick = e => {
  console.log(e);
}

export default function Chips({taxonomies}) {
  const classes = useStyles();
  
    return (
      <div className={classes.root}>
        {taxonomies && taxonomies.map(({name, description}, i ) => (
          <Chip 
            key={i}
            avatar={<Avatar>{name[0].toUpperCase()}</Avatar>} 
            label={name} 
            onClick={handleClick} 
          />
        ))}
      </div>
    )
}
