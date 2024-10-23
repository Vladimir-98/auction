const ADD_REMOVE_ORDER_FROM_CART = 'ADD_REMOVE_ORDER_FROM_CART';

const initialState = {
    orders: [],
    totalLeadPrice: 0,
};

const cartReducer = (state = initialState, action) => {
    switch (action.type) {
        case ADD_REMOVE_ORDER_FROM_CART:
            const order = action.order;
            const existingItem = state.orders.find(i => i.id === order.id);

            if (existingItem) {
                return {
                    ...state,
                    orders: state.orders.filter(item => item.id !== order.id),
                    totalLeadPrice: state.totalLeadPrice - order.leadPrice,
                };
            } else {
                return {
                    ...state,
                    orders: [...state.orders, order],
                    totalLeadPrice: state.totalLeadPrice + order.leadPrice,
                };
            }
        default:
            return state;
    }
};

export const addRemoveOrderFromCart = (order) => ({type: ADD_REMOVE_ORDER_FROM_CART, order});

export default cartReducer;
