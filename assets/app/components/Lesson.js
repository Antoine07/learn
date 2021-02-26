import React, { useEffect } from "react";
import { BrowserRouter as Router, useParams } from "react-router-dom";
import { makeStyles } from "@material-ui/core/styles";
import { Container, Grid, Paper, Box, Typography } from "@material-ui/core";

import { useDispatch, useSelector } from "react-redux";
import { getLessonById } from "../store/actions/actions-types";

const useStyles = makeStyles((theme) => ({
  root: {
    "& > *": {
      margin: theme.spacing(1),
    },
  },
}));

const Lesson = () => {
  const { id } = useParams();
  const dispatch = useDispatch();
  const classes = useStyles();
  const {
    lesson,
  } = useSelector((state) => state.lesson);

  useEffect(() => {
    dispatch(getLessonById({ id }));
  }, []);

  console.log(lesson);

  return (
    <div className={classes.root}>
        <Grid container>
          <Grid item md={12}>
            <Typography variant="h4" component="h1" gutterBottom>
                1
            </Typography>
            <Typography paragraph>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Rhoncus dolor purus non enim praesent elementum facilisis leo vel.
              Risus at ultrices mi tempus imperdiet. Semper risus in hendrerit
              gravida rutrum quisque non tellus. Convallis convallis tellus id
              interdum velit laoreet id donec ultrices. Odio morbi quis commodo
              odio aenean sed adipiscing. Amet nisl suscipit adipiscing bibendum
              est ultricies integer quis. Cursus euismod quis viverra nibh cras.
              Metus vulputate eu scelerisque felis imperdiet proin fermentum
              leo. Mauris commodo quis imperdiet massa tincidunt. Cras tincidunt
              lobortis feugiat vivamus at augue. At augue eget arcu dictum
              varius duis at consectetur lorem. Velit sed ullamcorper morbi
              tincidunt. Lorem donec massa sapien faucibus et molestie ac.
            </Typography>
          </Grid>
        </Grid>
    </div>
  );
};

export default Lesson;
