import ListItem from "../List";
import CardList from "../Card/CardList";
import Counter from "../Counter/Counter";
import Cards from '../../../upload/svg/cards.svg'
import Credit from '../../../upload/svg/credit.svg'

import {useNavigate} from "react-router";
import useAxios from "../../hooks/useAxios";
import {useTelegram} from "../../hooks/useTelegram";
import {useDispatch, useSelector} from "react-redux";
import {updateUser} from "../../reducers/userReducer";
import {addRemoveOrderFromCart} from "../../reducers/cartReducer";
import React, {Fragment, useCallback, useEffect, useRef} from "react";
import {updateFilter} from "../../reducers/filterReducer";


const Cart = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const cart = useSelector(state => state.cart);
    const {balance} = useSelector(state => state.user);
    const {prevRoute} = useSelector(state => state.route);
    const {buyOrders} = useAxios();

    const {
        vibrate,
        showPopup,
        showBackButton,
        hideBackButton,
        showMainButton,
        hideMainButton,
        setLoaderMainButton,
        setDisabledMainButton,
    } = useTelegram();

    const cartRef = useRef(cart);
    useEffect(() => {
        cartRef.current = cart
    }, [cart]);

    const {orders, totalLeadPrice} = cart
    const startTotalPrice = cartRef.current.totalLeadPrice;

    setDisabledMainButton(balance === 0 || totalLeadPrice === 0 || balance < totalLeadPrice);

    const toggleMainButtonState = (isDisabled) => {
        setDisabledMainButton(isDisabled);
        setLoaderMainButton(isDisabled);
    };

    const onClickMainButton = useCallback(async () => {

        const orders = cartRef.current.orders;

        if (orders.length > 0) {

            toggleMainButtonState(true);

            const cardIds = orders.map(order => order.id);

            return await buyOrders(cardIds)
                .then(({data}) => {

                    const newOrders = data?.orders;
                    const balance = data?.balance;
                    const filter = data?.filter;

                    dispatch(updateUser(balance));
                    dispatch(updateFilter(filter));
                    newOrders.map(order => {
                        dispatch(addRemoveOrderFromCart(order));
                    });

                    toggleMainButtonState(false);
                    vibrate('success');

                    if(newOrders.length < orders.length){
                        showPopup('Не удача!', 'Не все карточки удалось оплатить, возможно они больше не доступны.');
                    }

                })
                .catch(() => {
                    toggleMainButtonState(false);
                    vibrate('error');
                })

        }
    }, []);

    useEffect(() => {
        showBackButton(() => navigate(prevRoute))
        showMainButton('забрать', () => onClickMainButton())

        return () => {
            hideBackButton();
            hideMainButton();
            toggleMainButtonState(false);
        };
    }, [])

    const content = [
        {id: 1, subTitle: 'Всего: ', title: String(orders.length), img: Cards},
        {id: 2, subTitle: 'Общая сумма: ', title: <Counter start={startTotalPrice} end={totalLeadPrice}/>, img: Credit},
    ]

    return (
        <Fragment>
            <div className={'cart scroll'}>
                <div className={'list card-bg-color small'}>
                    {content && content.map(item =>
                        <ListItem
                            id={item.id}
                            title={item.title}
                            img={item.img}
                            subTitle={item.subTitle}
                            key={item.title + item.id}
                        />)}
                </div>

                <CardList items={orders} count={orders.length} hasMore={false}/>
            </div>

        </Fragment>
    );
}

export default Cart;
