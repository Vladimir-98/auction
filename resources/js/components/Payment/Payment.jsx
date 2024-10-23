import ListItem from "../List";
import Input from "../Forms/Input";
import CheckBox from "../Forms/CheckBox";

import {useNavigate} from "react-router";
import useAxios from "../../hooks/useAxios";
import {useTelegram} from "../../hooks/useTelegram";
import {useDispatch, useSelector} from "react-redux";
import {updateUser} from "../../reducers/userReducer";
import {INPUT_TYPES} from "../../constants/inputConstancts";
import {selectPayment, updateSum} from "../../reducers/paymentReducer";
import React, {Fragment, useCallback, useEffect, useRef} from "react";

const Payment = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const {handleCreateInvoiceLink} = useAxios();
    const items = useSelector(state => state.payment);
    const {prevRoute} = useSelector(state => state.route);
    const {checkTelegramData} = useAxios();

    const {
        initData,
        vibrate,
        openInvoice,
        showBackButton,
        hideBackButton,
        showMainButton,
        hideMainButton,
        setLoaderMainButton,
        setDisabledMainButton,
    } = useTelegram();

    const payment = items.find(item => item.active);

    setDisabledMainButton(payment.sum <= 0);

    const sum = useRef(payment.sum);
    useEffect(() => {
        sum.current = payment.sum;
    }, [payment.sum])

    const onClickPayment = useCallback(async () => {

        if (sum.current > 0) {
            setLoaderMainButton(true);
            setDisabledMainButton(true);

            const invoiceLink = await handleCreateInvoiceLink(sum.current, initData);

            if (!invoiceLink) {
                setLoaderMainButton(false);
                setDisabledMainButton(false);
                vibrate('error');
                alert('Обратитесь к администратору');
                return;
            }

            const resetDisabled = async () => {
                setLoaderMainButton(false);
                setDisabledMainButton(false);

                await checkTelegramData(initData).then(({data, success})=> {
                    if (success) {
                        dispatch(updateUser(data.balance));
                        dispatch(selectPayment(1));
                    }
                });

                vibrate('success');
            }

            await openInvoice(invoiceLink, (status) => {
                switch (status) {
                    case 'pending':
                    case 'failed':
                    case 'cancelled':
                    case 'paid':
                        resetDisabled();
                        break;
                    default:
                        break;
                }
            });

        }
    }, [])

    useEffect(() => {
        showBackButton(() => navigate(prevRoute));
        showMainButton('оплатить', () => onClickPayment());

        return () => {
            hideBackButton();
            hideMainButton();
        }
    }, []);

    const onChangeSum = (pId, value) => {
        dispatch(updateSum(pId, value))
    }

    const handleSelectPayment = (pId) => {
        dispatch(selectPayment(pId))
    }

    return (
        <Fragment>
            <div className={'payment list card-bg-color small'}>
                {items && items.map(item =>
                    <ListItem
                        id={item.id}
                        type={item.type}
                        name={item.name}
                        // title={item.title}
                        key={item.id}
                        onClick={handleSelectPayment}
                    >
                        {item.type === INPUT_TYPES.INPUT && (
                            <Input
                                id={item.id}
                                key={item.id}
                                label={item.title}
                                value={item.sum}
                                inputType={'number'}
                                onChange={onChangeSum}
                            />
                        )}

                        {item.type === INPUT_TYPES.CHECKBOX && (
                            <CheckBox
                                value={'value'}
                                name={item.title}
                                active={item.active}
                            />
                        )}

                    </ListItem>)
                }
            </div>
        </Fragment>
    );
}

export default Payment;
