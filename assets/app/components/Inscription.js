import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";

import { makeStyles } from "@material-ui/core/styles";
import {
  TextField,
  FormControl,
  Input,
  FormHelperText,
  InputLabel,
  Grid,
  Typography,
  Button
} from "@material-ui/core";
import { loginPassword, set_login } from "../store/actions/actions-types";

const useStyles = makeStyles((theme) => ({
  root: {
    "& > *": {
      margin: theme.spacing(1),
      width: "25ch",
    },
  },
}));

const Inscription = () => {
  const classes = useStyles();
  const dispatch = useDispatch();
  const { email, password } = useSelector(state => state.i);

  useEffect(() => {
    
  }, [email, password]);

  const handleChangeL = e => {
      const { name, value } = e.target;

      dispatch(set_login({ name, value }));
  }

  const handleSubmit = e => {
      e.preventDefault();

      dispatch(loginPassword({email, password}));
  }

  return (
    <Grid container spacing={2}>
      <Grid item md={6} >
        <Typography variant="h4" component="h1" gutterBottom>
          Login
        </Typography>
        <form className={classes.root} noValidate autoComplete="off">
          <div>
            <FormControl>
              <InputLabel htmlFor="my-input">Email address</InputLabel>
              <Input
              onChange={handleChangeL} name="email"
              id="my-input" aria-describedby="my-helper-text" />
              <FormHelperText id="my-helper-text">
                We'll never share your email.
              </FormHelperText>
            </FormControl>
          </div>
          <div>
            <FormControl>
              <InputLabel htmlFor="my-input">Password</InputLabel>
              <Input
              onChange={handleChangeL} name="password"
              id="my-input" aria-describedby="my-helper-text" />
            </FormControl>
          </div>
          <Button variant="contained" color="primary">
            Login
          </Button>
        </form>
      </Grid>
      <Grid item md={6}>
        <Typography variant="h4" component="h1" gutterBottom>
          Inscription
        </Typography>
        <form className={classes.root} noValidate autoComplete="off">
          <div>
            <FormControl>
              <InputLabel htmlFor="my-input">Email address</InputLabel>
              <Input id="my-input" aria-describedby="my-helper-text" />
              <FormHelperText id="my-helper-text">
                We'll never share your email.
              </FormHelperText>
            </FormControl>
          </div>
          <div>
            <FormControl>
              <InputLabel htmlFor="my-input">Password</InputLabel>
              <Input id="my-input" aria-describedby="my-helper-text" />
              <FormHelperText id="my-helper-text">
                We'll never share your email.
              </FormHelperText>
            </FormControl>
          </div>
        </form>
      </Grid>
    </Grid>
  );
};

export default Inscription;
