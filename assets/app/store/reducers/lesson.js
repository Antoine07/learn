import {
  SET_BEST_LESSONS,
  SET_LESSONS,
  LOADING_LESSONS,
  FILTER_LESSONS,
  GET_LESSON
} from "../constants/actions";

const stateInit = {
  count: 0,
  countBest: 0,
  lessons: [],
  best: [],
  search: [],
  filtersSanitize: ["closed", "free", "rate"],
  filters: [],
  isLoading: true,
  id: null,
  reset: false,
  rate: null,
  lesson : null
};

const reducer = (state = stateInit, action) => {
  switch (action.type) {
    case SET_LESSONS:
      const { lessons } = action.payload;

      return {
        ...state,
        lessons: state.lessons.concat(lessons),
        count: lessons.length,
      };

    case SET_BEST_LESSONS:
      const { best } = action.payload;
      const rate = best.slice(0, 1)[0]?.rate;

      return {
        ...state,
        best: state.best.concat(best),
        countBest: best.length,
        rate,
      };

    case LOADING_LESSONS:
      return {
        ...state,
        isLoading: action.payload,
      };

    case FILTER_LESSONS:
      const { filter: f, reset } = action.payload;
      let search = [];

      if (reset === true) {
        return {
          ...state,
          filters: [],
          search: [],
          reset
        };
      }

      if (f === "rate") {
        search = search.concat(
          state.lessons.filter((lesson) => lesson.rate === state.rate)
        );
      }

      const filters = state.filters.concat(f);
      const regex = new RegExp(filters.join("|"));

      search = search.concat(
        state.lessons.filter((lesson) => {
          return (
            lesson.taxonomies.filter((taxonomy) => regex.test(taxonomy.name))
              .length > 0
          );
        })
      );

      return {
        ...state,
        search: state.search.concat(search),
        filters,
        reset,
      };

      return {
        ...state,
        isLoading: action.payload,
      };

    case GET_LESSON:
      const { id } = action.payload;
      const lesson = state.lessons.filter( lesson => lesson.id == id );

      return{
        ...state,
        lesson
      }

    default:
      return state;
  }
};

export default reducer;
