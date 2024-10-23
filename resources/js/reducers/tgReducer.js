const SET_TG = 'SET_TG';

const initialState = {
    tg: null,
    classes: 'dark desktop',
};

export const tgReducer = (state = initialState, action) => {
    switch (action.type) {
        case 'SET_TG':
            return {
                ...state,
                tg: action.tg,
            };
        default:
            return state;
    }
};

export const setTg = (tg) => ({type: SET_TG, tg})


