import './App.scss';

import Cart from "../Cart";
import Header from "../Header";
import Orders from "../Orders";
import Payment from "../Payment";
import Category from "../Category";
import ScrollTop from "../ScrollTop";
import TotalLeadPrice from "../TotalLeadPrice";

import {useDispatch} from "react-redux";
import useAxios from "../../hooks/useAxios";
import {setTg} from "../../reducers/tgReducer";
import React, {Fragment, useEffect} from 'react';
import {useTelegram} from "../../hooks/useTelegram";
import {updateUser} from "../../reducers/userReducer";
import {updateFilter} from "../../reducers/filterReducer";
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import {CATEGORY_ROUTE, ORDERS_ROUTE, CART_ROUTE, PAYMENT_ROUTE} from "../../constants/routesConstants";

const App = () => {
    const dispatch = useDispatch();
    const tg = window.Telegram.WebApp;
    const {checkTelegramData} = useAxios();
    const {isValid, getPlatform} = useTelegram();

    useEffect(() => {

        const {platform, colorScheme} = tg;
        document.body.classList.add(colorScheme, getPlatform(platform));

        checkTelegramData().then(({data, success}) => {
            if (success) {
                tg.isValid = success;
                dispatch(setTg(tg));
                dispatch(updateUser(data.balance));
                dispatch(updateFilter(data.filter));
            }
        });
    }, [tg]);

    if (!isValid) return null;

    return (
        <Router>
            <ScrollTop/>
            {/*<ColorTgExample/>*/}
            <Header/>
            <div className="body">
                <Fragment>
                    <Routes>
                        <Route path={CART_ROUTE} element={<Cart/>}/>
                        <Route path={ORDERS_ROUTE} element={<Orders/>}/>
                        <Route path={PAYMENT_ROUTE} element={<Payment/>}/>
                        <Route path={CATEGORY_ROUTE} element={<Category/>}/>
                    </Routes>
                    <TotalLeadPrice/>
                </Fragment>
            </div>
        </Router>
    );
}

export default App;
