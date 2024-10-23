import {INPUT_TYPES} from "../constants/inputConstancts";

const UPDATE_SUM = 'UPDATE_SUM';
const SELECT_PAYMENT = 'SELECT_CHOICE';

const initialState = [
    {
        id: 1,
        title: '1000',
        active: true,
        sum: 1000,
        type: INPUT_TYPES.CHECKBOX,
    },
    {
        id: 2,
        title: '3000',
        active: false,
        sum: 3000,
        type: INPUT_TYPES.CHECKBOX,
    },
    {
        id: 3,
        title: '5000',
        active: false,
        sum: 5000,
        type: INPUT_TYPES.CHECKBOX,
    },
    {
        id: 4,
        title: '7000',
        active: false,
        sum: 7000,
        type: INPUT_TYPES.CHECKBOX,
    },
    {
        id: 5,
        title: 'Своя сумма: ',
        active: false,
        sum: 0,
        type: INPUT_TYPES.INPUT,
    },
];

const paymentReducer = (state = initialState, action) => {
    switch (action.type) {

        case SELECT_PAYMENT:
            return state.map(payment => {
                    return {
                        ...payment,
                        active: payment.id === action.paymentId,
                        sum: payment.type === INPUT_TYPES.INPUT ? 0 : payment.sum
                    }
                }
            );

        case UPDATE_SUM:
            return state.map(payment => {
                if (payment.id === action.paymentId) {
                    return {
                        ...payment,
                        sum: Number(action.paymentSum.replace(/\s+/g, ''))
                    };
                }
                return payment;
            });


        default:
            return state;
    }
};

export const selectPayment = (paymentId) => ({type: SELECT_PAYMENT, paymentId});
export const updateSum = (paymentId, paymentSum) => ({type: UPDATE_SUM, paymentId, paymentSum});

export default paymentReducer;
