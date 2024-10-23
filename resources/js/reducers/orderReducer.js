const ORDERS_RESET = 'ORDERS_RESET';
const ORDERS_REQUEST = 'ORDERS_REQUEST';
const ORDERS_SUCCESS = 'ORDERS_SUCCESS';
const ORDERS_FAILURE = 'ORDERS_FAILURE';

const initialState = {
    items: [],
    loading: false,
    page: null,
    hasMore: true,
};

const orderReducer = (state = initialState, action) => {
    switch (action.type) {

        case ORDERS_REQUEST:
            return {...state, loading: true};

        case ORDERS_SUCCESS:
            return {
                ...state,
                items: [...state.items, ...action.orders],
                loading: false,
                page: action.page + 1,
                hasMore: action.hasMore,
            };

        case ORDERS_FAILURE:
            return {...state, loading: false};

        case ORDERS_RESET:
            return {
                ...state,
                items: [],
                loading: false,
                page: null,
                hasMore: true,
            };

        default:
            return state;
    }
};

export const ordersReset = () => ({type: ORDERS_RESET});
export const ordersRequest = () => ({type: ORDERS_REQUEST});
export const ordersSuccess = (orders, page, hasMore) => ({type: ORDERS_SUCCESS, orders, page, hasMore});
export const ordersFailure = () => ({type: ORDERS_FAILURE});

export default orderReducer;
