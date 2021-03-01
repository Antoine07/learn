import { SET_LOGIN } from '../constants/actions';

const stateInit = {
    email : null, 
    password : null,
    choices : [
         {
            name : "Abonnement 1 jours",
            checked : false,
            label : 'sub_01'
        },
         {
            name : "Abonnement 5 jours",
            checked : false,
            label : 'sub_02'
        },
        {
            name : "Abonnement 15 jours",
            checked : false,
            label : 'sub_02'
        },
    ]
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