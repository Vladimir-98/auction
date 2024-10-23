const UPDATE_PREV_ROUTE = 'UPDATE_PREV_ROUTE';

const initialState = {
    prevRoute: ''
};

const routeReducer = (state = initialState, action) => {
    switch (action.type) {
        case UPDATE_PREV_ROUTE:
            return {...state, prevRoute: action.prevRoute}

        default:
            return state;
    }
};

export const updatePrevRoute = (prevRoute) => ({type: UPDATE_PREV_ROUTE, prevRoute});

export default routeReducer;
