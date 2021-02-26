import React, { useEffect, useRef } from "react";
import { makeStyles } from "@material-ui/core/styles";
import Avatar from "@material-ui/core/Avatar";
import Chip from "@material-ui/core/Chip";

import { useDispatch, useSelector } from "react-redux";
import { filter_lessons } from "../store/actions/actions-types";

const useStyles = makeStyles((theme) => ({
  root: {
    display: "flex",
    justifyContent: "center",
    flexWrap: "wrap",
    "& > *": {
      margin: theme.spacing(0.5),
    },
  },
}));

const Filter = () => {
  const classes = useStyles();
  const dispatch = useDispatch();
  const { filters } = useSelector((state) => state.lesson);

  const handleSearch = (e, filter) => {
    const reset = filter === "reset";
    dispatch(filter_lessons({ filter, reset }));
  };

  return (
    <div className={classes.root}>
      <Chip
        avatar={<Avatar>R</Avatar>}
        label="Reset"
        onClick={(e) => handleSearch(e, "reset")}
      />
      <Chip
        avatar={<Avatar>B</Avatar>}
        label="Meilleur notation"
        onClick={(e) => handleSearch(e, "rate")}
        disabled={ filters.includes('rate') }
      />
      <Chip
        avatar={<Avatar>G</Avatar>}
        label="Gratuit"
        onClick={(e) => handleSearch(e, "free")}
        disabled={ filters.includes('free') }
      />
      <Chip
        avatar={<Avatar>P</Avatar>}
        label="Payant"
        onClick={(e) => handleSearch(e, "closed")}
        disabled={ filters.includes('closed') }
      />
    </div>
  );
};

export default Filter;
