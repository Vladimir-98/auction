import {tgReducer} from "../reducers/tgReducer";
import cartReducer from "../reducers/cartReducer";
import {combineReducers, createStore} from "redux";
import orderReducer from "../reducers/orderReducer";
import routeReducer from "../reducers/routeReducer";
import filterReducer from "../reducers/filterReducer";
import paymentReducer from "../reducers/paymentReducer";
import userReducer from "../reducers/userReducer";

let reducers = combineReducers({
    tg: tgReducer,
    cart: cartReducer,
    user: userReducer,
    route: routeReducer,
    orders: orderReducer,
    filter: filterReducer,
    payment: paymentReducer,
})

let store = createStore(
    reducers
);

export default store;

