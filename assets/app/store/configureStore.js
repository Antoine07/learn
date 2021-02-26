import { applyMiddleware, createStore } from 'redux';
import thunkMiddleware from 'redux-thunk';

import rootReducer from './reducers';

const  configureStore = (preloadedState = {}) => {
    const middlewares = [thunkMiddleware];
    const middlewareEnhancer = applyMiddleware(...middlewares);

    const store = createStore(rootReducer, preloadedState, middlewareEnhancer);

    return store;
}

export default configureStore;
