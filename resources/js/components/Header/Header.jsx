import './Header.scss';
import Counter from "../Counter";
import wallet from "../../../upload/svg/wallet.svg";

import React, { Fragment, useEffect, useRef } from "react";
import { useNavigate } from "react-router";
import { useLocation } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { updatePrevRoute } from "../../reducers/routeReducer";
import { CATEGORY_ROUTE, PAYMENT_ROUTE } from "../../constants/routesConstants";

const Header = () => {
    const location = useLocation();
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const { balance } = useSelector(state => state.user);

    const activeClass = location.pathname !== CATEGORY_ROUTE;

    const balanceRef = useRef(balance);
    useEffect(() => {
        balanceRef.current = balance;
    }, [balance]);
    const startBalance = balanceRef.current;

    const handleOnClickWallet = () => {
        dispatch(updatePrevRoute(location.pathname));
        navigate(PAYMENT_ROUTE);
    };

    return (
        <Fragment>
            <div
                className={`header ${activeClass ? 'active' : ''}`}>
                <div className={'wallet'}>
                    <div className={'wallet__img'}>
                        <img src={wallet} alt=""/>
                    </div>
                    <div className="wallet__title text-color">
                        <h3>
                            <Counter start={startBalance} end={balance} />
                        </h3>
                    </div>
                    <div
                        onClick={() => handleOnClickWallet()}
                        className={'wallet__link link-color'}
                    >Пополнить баланс
                    </div>
                </div>
            </div>
        </Fragment>
    );
}

export default Header;
