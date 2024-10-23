import Filter from "../Filter";
import OrdersList from "./OrdersList";

import {useNavigate} from "react-router-dom";
import React, {Fragment, useEffect} from "react";
import {useTelegram} from "../../hooks/useTelegram";
import {CATEGORY_ROUTE} from "../../constants/routesConstants";

const Orders = () => {
    const navigate = useNavigate();

    const {
        showBackButton,
        hideBackButton
    } = useTelegram();

    useEffect(() => {
        showBackButton(() => navigate(CATEGORY_ROUTE))
        return () => hideBackButton();
    }, []);

    return (
        <Fragment>
            <Filter/>
            <OrdersList/>
        </Fragment>
    );
}

export default Orders;
