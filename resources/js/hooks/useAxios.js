import axios from 'axios'

import {
    ORDERS,
    BASE_URL,
    VALIDATION,
    BUY_ORDERS,
    CREATE_LINK_INVOICE,
} from "../constants/routesConstants";

const instance = axios.create({
    baseURL: BASE_URL,
    withCredentials: true,
    headers: {
        'X-Init-Data': window.Telegram.WebApp?.initData,
    },
});

const useAxios = () => {

    const getAllOrders = async (filter, page) => {
        return await handleRequest(async () => {
            const response = await instance.post(ORDERS, {filter, page});
            return response.data;
        }, 'Не удалось получить заявки');
    }

    const buyOrders = async (cardIds) => {
        return await handleRequest(async () => {
            const response = await instance.post(BUY_ORDERS, {cardIds});
            return response.data;
        }, 'Не удалось забрать заявки');
    }

    const checkTelegramData = async () => {
        return await handleRequest(async () => {
            const response = await instance.post(VALIDATION);
            return response.data;
        }, 'Проверка не пройдена');
    }

    const handleCreateInvoiceLink = async (sum) => {
        return await handleRequest(async () => {
            const response = await instance.post(CREATE_LINK_INVOICE, {sum});
            return response.data?.data.invoiceLink;
        }, 'Ошибка при создании ссылки на оплату');
    }

    const handleRequest = async (request, errorMessage) => {
        try {
            return await request();
        } catch (error) {
            console.warn(`${errorMessage}`);
        }
    }

    return {
        buyOrders,
        getAllOrders,
        checkTelegramData,
        handleCreateInvoiceLink
    };
}

export default useAxios;
