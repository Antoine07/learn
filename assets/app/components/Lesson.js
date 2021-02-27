import React, { useEffect } from "react";
import { BrowserRouter as Router, useParams } from "react-router-dom";
import { makeStyles } from "@material-ui/core/styles";
import { Grid, Typography, SnackbarContent, Button } from "@material-ui/core";

import { Prism as SyntaxHighlighter } from 'react-syntax-highlighter';
import { dark } from 'react-syntax-highlighter/dist/esm/styles/prism';

import { useDispatch, useSelector } from "react-redux";
import { getLessonById } from "../store/actions/actions-types";

import Progess from './Progess';

const useStyles = makeStyles((theme) => ({
  root: {
    "& > *": {
      margin: theme.spacing(1),
    },
  },
}));

const action = (
  <Button color="secondary" size="small">
    lorem ipsum dolorem
  </Button>
);

const Lesson = () => {
  const { id } = useParams();
  const dispatch = useDispatch();
  const classes = useStyles();
  const codeString = `
      const sum = ({ numbers }) => ( 
        [...numbers ].reduce((curr, acc) => acc + curr )
      );

      // React Component unpacking property title
      const Content = ({ title }) => {

        // brackets xss protection
        return (
          <p>{title}</p>
        )
      }
  `;
  const {
    lesson
  } = useSelector((state) => state.lesson);

  useEffect(() => {
    dispatch(getLessonById({ id }));
  }, []);

  return (
    <div className={classes.root}>
      {lesson && (
        <Grid container>
          <Grid item md={4} >
            <Typography variant="h4" component="h1" gutterBottom>
             Progress bar
            </Typography>
          </Grid>
          <Grid item md={8}>
            <Typography variant="h4" component="h1" gutterBottom>
              {lesson.name}
            </Typography>
            <Typography paragraph>
              {lesson.content}
            </Typography>
            <Typography paragraph>
              <SyntaxHighlighter language="javascript" style={dark}>
                {codeString}
              </SyntaxHighlighter>
                <SnackbarContent
                  message={
                    'I love candy. I love cookies. I love cupcakes. \
                     I love cheesecake. I love chocolate.'
                  }
                />
            </Typography>
          </Grid>
        </Grid>
      )}
    </div>
  );
};

export default Lesson;
