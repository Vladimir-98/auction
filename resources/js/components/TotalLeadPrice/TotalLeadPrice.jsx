import './TotalLeadPrice.scss'

import Badge from "../Badge";
import Counter from "../Counter";
import Shop from '../../../upload/svg/shop.svg'

import React, {useEffect, useRef} from 'react';
import {useDispatch, useSelector} from "react-redux";
import {useNavigate, useLocation} from "react-router-dom";
import {CART_ROUTE, PAYMENT_ROUTE} from "../../constants/routesConstants";
import {updatePrevRoute} from "../../reducers/routeReducer";

const TotalLeadPrice = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const location = useLocation();
    const {totalLeadPrice, orders} = useSelector(state => state.cart)
    const prevTotalLeadPrice = useRef(totalLeadPrice);
    const countOrders = orders.length;

    useEffect(() => {
        prevTotalLeadPrice.current = totalLeadPrice;
    }, [totalLeadPrice]);

    const startTotal = prevTotalLeadPrice.current;

    const handleOnClickCart = () => {
        dispatch(updatePrevRoute(location.pathname));
        navigate(CART_ROUTE);
    };

    const isCardRoute =
        location.pathname === CART_ROUTE || location.pathname === PAYMENT_ROUTE;

    return (
        <div
            onClick={handleOnClickCart}
            className={'total-popup' + (totalLeadPrice && !isCardRoute ? ' active' : '')}>
            <div className={'total-popup__content'}>
                <div className={'total-popup__title'}>
                    <h3>
                        <Counter start={startTotal} end={totalLeadPrice}/>
                    </h3>
                    <span>общая сумма</span>
                </div>
                <div className={'total-popup__cart'}>
                    <Badge total={countOrders}/>
                    <div
                        className={'total-popup__cart-icon'}>
                        <img src={Shop} alt="Shop"/>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default TotalLeadPrice;
