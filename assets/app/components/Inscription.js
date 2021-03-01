import React, { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";

import { makeStyles } from "@material-ui/core/styles";
import {
  FormControl,
  Input,
  FormHelperText,
  InputLabel,
  Grid,
  Typography,
  Button,
  Checkbox,
  FormLabel,
  FormGroup,
  FormControlLabel
} from "@material-ui/core";
import { loginPassword, set_login } from "../store/actions/actions-types";

const useStyles = makeStyles((theme) => ({
  root: {
    "& > *": {
      margin: theme.spacing(1),
    },
    formControl: {
      margin: theme.spacing(3),
    },
  },
}));

const Inscription = () => {
  const classes = useStyles();
  const dispatch = useDispatch();
  const { email, password, choices } = useSelector(state => state.i);

  useEffect(() => {

  }, [email, password]);

  const handleChange = e => {
    const { name, value } = e.target;

    dispatch(set_login({ name, value }));
  }

  const handleSubmit = e => {
    e.preventDefault();
    const { name } = e.target;

    if (name === 'login')
      dispatch(loginPassword({ email, password }));
  }

  return (
    <Grid container spacing={2}>
      <Grid item md={12}>
        <Typography variant="h4" component="h1" gutterBottom>
          Inscription
        </Typography>
        <form className={classes.root} name="inscription">
          <div>
            <FormControl fullWidth={true}>
              <InputLabel htmlFor="my-input">Email address</InputLabel>
              <Input
                onChange={handleChange}
                name="email"
                id="my-input1" aria-describedby="my-helper-text" />
              <FormHelperText id="my-helper-text">
                We'll never share your email.
              </FormHelperText>
            </FormControl>
          </div>
          <div>
            <FormControl fullWidth={true}>
              <InputLabel
                onChange={handleChange}
                name="password"
                htmlFor="my-input2"
              >Password</InputLabel>
              <Input id="my-input" aria-describedby="my-helper-text" />
              <FormHelperText id="my-helper-text">
                We'll never share your email.
              </FormHelperText>
            </FormControl>
          </div>
          <div>
            <FormControl fullWidth={true}>
              <InputLabel
                onChange={handleChange}
                name="passwordc"
                htmlFor="my-input3"
              >Password confirme</InputLabel>
              <Input id="my-input" aria-describedby="my-helper-text" />
              <FormHelperText id="my-helper-text">
                We'll never share your email.
              </FormHelperText>
            </FormControl>
          </div>
          <div>
            <FormControl component="fieldset" fullWidth={true}>
              <FormLabel component="legend">Choix de l'abonnement</FormLabel>
              <FormGroup>
                {choices.map(({ name, checked, label }, i) =>
                  <FormControlLabel
                    key={i}
                    control={<Checkbox checked={checked} onChange={handleChange} name={label} />}
                    label={name}
                  />
                )}
              </FormGroup>
              <FormHelperText>Choix unique</FormHelperText>
            </FormControl>
            <FormControl>
              <Button variant="contained" color="primary" type="submit">
                Login
              </Button>
            </FormControl>
          </div>
        </form>
      </Grid>
    </Grid>
  );
};

export default Inscription;
