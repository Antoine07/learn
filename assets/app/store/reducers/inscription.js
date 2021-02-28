import { SET_LOGIN } from '../constants/actions';

const stateInit = {
    email : null, 
    password : null
  };

const reducer = (state = stateInit, action) => {
  
    switch(action.type){
        case SET_LOGIN:
            const { name, value } = action.payload;

            return {
                ...state,
                [name] : value
            }

        default:
            return state
    }
};

export default reducer;