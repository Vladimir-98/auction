import Card from "./Card";
import React, {Fragment} from "react";
import CardSkeleton from "./CardSkeleton";
import {useTelegram} from "../../hooks/useTelegram";
import {useDispatch, useSelector} from "react-redux";
import {addRemoveOrderFromCart} from "../../reducers/cartReducer";

const CardList = ({items, loading = false, count = 5, hasMore = true}) => {

    const {vibrate} = useTelegram()
    const dispatch = useDispatch();
    const {orders: cartOrders} = useSelector(state => state.cart);

    const onClickCard = (order) => {
        dispatch(addRemoveOrderFromCart(order))
        vibrate('medium');
    };

    const getChoice = (order) => {
        return cartOrders.some(cartOrder => cartOrder.id === order.id);
    };

    return (
        <Fragment>
            {
                items.length > 0 &&
                items.map(o => (
                    <Card
                        key={o.id}
                        id={o.id}
                        name={o.name}
                        leadPrice={o.leadPrice}
                        budget={o.budget}
                        paymentType={o.paymentType}
                        districts={o.districts}
                        categories={o.categories}
                        choice={getChoice(o)}
                        onClick={() => onClickCard(o)}
                    />
                ))

            }

            {!loading && items.length === 0 && (
                <div className={'card__title'}>
                    <h4>Ничего не найдено!</h4>
                </div>
            )}

            {
                hasMore && (
                    <div className={'target-scroll'}>
                        {Array.from({length: count}, (_, index) => (
                            <CardSkeleton key={index}/>
                        ))}
                    </div>
                )
            }
        </Fragment>
    );
}

export default CardList;
