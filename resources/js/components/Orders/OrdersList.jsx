import CardList from "../Card/CardList";

import useAxios from "../../hooks/useAxios";
import {useNavigate} from "react-router-dom";
import React, {useCallback, useEffect} from "react";
import {useTelegram} from "../../hooks/useTelegram";
import {useDispatch, useSelector} from "react-redux";
import {setFormData} from "../../reducers/filterReducer";
import {getFilterData} from "../../selectors/filterSelector";
import {CATEGORY_ROUTE} from "../../constants/routesConstants";
import {ordersFailure, ordersRequest, ordersReset, ordersSuccess} from "../../reducers/orderReducer";

const OrdersList = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const {getAllOrders} = useAxios();
    const {items: filters, formData} = useSelector(state => state.filter);
    const {items, loading, hasMore, page} = useSelector(state => state.orders);
    const {
        vibrate,
        showBackButton,
        hideBackButton
    } = useTelegram();

    const filter = getFilterData(filters);

    const getOrders = useCallback(async (currentPage) => {
        dispatch(ordersRequest());

        return await getAllOrders(filter, currentPage).then(({data}) => {
            dispatch(ordersSuccess(data?.orders, data?.page, data?.hasMore));
            vibrate('success');
        }).catch(e => {
            dispatch(ordersFailure());
            vibrate('error');
        });

    }, [filters])

    useEffect(() => {
        showBackButton(() => navigate(CATEGORY_ROUTE))
        return () => hideBackButton();
    }, []);

    useEffect(() => {
        // if (JSON.stringify(filter) !== JSON.stringify(formData) && !loading) {
        if (!loading){
            dispatch(ordersReset());
            dispatch(setFormData(filter))
            getOrders(1);
        }
        // }
    }, [filters])

    useEffect(() => {
        const targetElement = document.querySelector('.target-scroll');

        if (targetElement) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting && !loading && hasMore) {
                        getOrders(page);
                    }
                });
            });

            observer.observe(targetElement);

            return () => {
                observer.unobserve(targetElement);
            };
        }
    }, [loading, hasMore, page]);

    return <CardList items={items} loading={loading} hasMore={hasMore}/>;
}

export default OrdersList;
