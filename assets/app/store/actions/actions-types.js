import {
  SET_LESSONS,
  URL_LAST_LESSONS,
  LOADING_LESSONS,
  SET_BEST_LESSONS,
  MAX_BEST,
  FILTER_LESSONS,
  URL_API,
  GET_LESSON,
  URL_PASSWORD,
  SET_LOGIN
} from "../constants/actions";

import axios from "axios";

export const set_lessons = (payload) => {
  return {
    type: SET_LESSONS,
    payload,
  };
};

export const set_best_lessons = (payload) => {
  return {
    type: SET_BEST_LESSONS,
    payload,
  };
};

export const set_isLoading = (payload) => {
  return { type: LOADING_LESSONS, payload };
};

export const filter_lessons = (payload) => {
  return { type: FILTER_LESSONS, payload };
};

export const getApiLessons = (
  status = ["publish", "private"],
  maxBest = MAX_BEST
) => {
  return (dispatch) => {
    (async () => {
      try {
        const headers = {
          "Content-Type": "application/json",
          "Access-Control-Allow-Origin": "*",
        };
        dispatch(set_isLoading(true));
        const { data } = await axios.get(URL_LAST_LESSONS, headers);
        dispatch(set_isLoading(false));

        dispatch(set_lessons({ lessons: data }));
        dispatch(set_best_lessons({ best: data.slice(0, maxBest) }));
      } catch (err) {
        console.error("Axios getApiLastLessons :", err);
      } finally {
        // TODO
      }
    })();
  };
};

export const getLessonById = (payload) => ({ type: GET_LESSON, payload });

// TODO
export const getLessonByIdApi = (payload) => {
  return (dispatch) => {
    (async () => {
      try {
        const headers = {
          "Content-Type": "application/json",
        };

        const { id } = payload;

        dispatch(set_isLoading(true));
        const { data } = await axios.get(URL_API + "/" + id, headers);
        dispatch(set_isLoading(false));

        dispatch(set_lesson({ lesson: data }));
      } catch (err) {
        console.error("Axios getApiLastLessons :", err);
      } finally {
        // TODO
      }
    })();
  };
};

// Login/Password

export const loginPassword = (payload) => {
  return (dispatch) => {
    (async () => {
      try {
        const { email, password } = payload;

        const { data } = await axios.post(URL_PASSWORD, {
          login, password
        });
        dispatch(logged({ user : data }));

      } catch (err) {
        console.error("Axios loginPassword :", err);
      } finally {
        // TODO
      }
    })();
  };
};

export const logged = (payload) => ({ type: LOGGED, payload });
export const set_login = (payload) => ({ type: SET_LOGIN, payload });