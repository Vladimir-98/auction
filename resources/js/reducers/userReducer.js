const UPDATE = 'UPDATE';

const initialState = {
    balance: 0,
};

const userReducer = (state = initialState, action) => {
    switch (action.type) {
        case UPDATE:
            return {...state, balance: action.balance}
        default:
            return state;
    }
};

export const updateUser = (balance) => ({type: UPDATE, balance});

export default userReducer;
