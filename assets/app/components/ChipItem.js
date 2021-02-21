import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Avatar from '@material-ui/core/Avatar';
import Chip from '@material-ui/core/Chip';
import FaceIcon from '@material-ui/icons/Face';
import DoneIcon from '@material-ui/icons/Done';

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

export default function Chips({ number, classic = true, titles = [] }) {
  const classes = useStyles();

  const handleDelete = () => {
    console.info('You clicked the delete icon.');
  };

  const handleClick = () => {
    console.info('You clicked the Chip.');
  };


  const Items = [
    <Chip label="Basic" />,
    <Chip label="Symfony" disabled />,
    <Chip avatar={<Avatar>M</Avatar>} label="Python" onClick={handleClick} />,
    <Chip
      avatar={<Avatar alt="Natacha" src="/static/images/avatar/1.jpg" />}
      label="Data"
    />,
    <Chip
      icon={<FaceIcon />}
      label="ML"
      onClick={handleClick}
    />,
    <Chip
      label="JS"
      onClick={handleClick}
      deleteIcon={<DoneIcon />}
    />,
    <Chip
      icon={<FaceIcon />}
      label="PHP"
      color="secondary"
    />
  ];


  if (classic)
    return (
      <div className={classes.root}>
        {Items.slice(0, number).map((item, i) => (
          item
        ))}
      </div>
    );

  if (!classic)
    return (
      <div className={classes.root}>
        {titles.map((t, i) => (
           <Chip
            key={i}
            icon={<FaceIcon />}
            label={t}
            onClick={handleClick}
         />
        ))}
      </div>
    )
}
