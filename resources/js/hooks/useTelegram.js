import {useRef} from 'react';
import {useSelector} from 'react-redux';

/**
 * Hook for Telegram Mini Apps
 */
export function useTelegram() {
    const tg = useSelector(state => state.tg.tg);
    const mainButtonCallback = useRef(null);
    const backButtonCallback = useRef(null);

    const isValid = tg?.isValid;
    const initData = tg?.initData;

    const getPlatform = (platform) => {

        switch (platform) {
            case 'android':
            case 'android_x':
                return 'android'
            case 'ios':
            case 'macos':
            case 'mobile':
                return 'ios'
            case 'desktop':
            case 'tdesktop':
            case 'web':
            case 'weba':
            case 'webk':
            case 'unigram':
            case 'unknown':
                return 'desktop'
            default:
                return 'desktop'
        }
    }

    /**
     * Show MainButton
     * @param text
     * @param callback
     * @returns {void}
     */
    const showMainButton = (text, callback) => {
        if (mainButtonCallback.current) {
            tg.MainButton.offClick(mainButtonCallback.current);
        }

        mainButtonCallback.current = callback;
        tg.MainButton.text = text || 'Submit';
        tg.MainButton.onClick(mainButtonCallback.current);
        tg.MainButton.show();
    };

    /**
     * Hide MainButton
     * @returns {void}
     */
    const hideMainButton = () => {
        if (mainButtonCallback.current) {
            tg.MainButton.offClick(mainButtonCallback.current);
            mainButtonCallback.current = null;
        }
        tg.MainButton.hide();
    };

    /**
     * Enabled || Disabled MainButton
     * @param state
     * @returns {void}
     */
    const setDisabledMainButton = (state = true) => {
        if (state) {
            tg.MainButton.disable();
        } else {
            tg.MainButton.enable();
        }
    };

    /**
     * Show BackButton
     * @param callback
     * @returns {void}
     */
    const showBackButton = (callback) => {
        if (!tg) return;

        if (backButtonCallback.current) {
            tg.BackButton.offClick(backButtonCallback.current);
        }

        backButtonCallback.current = callback;
        tg.BackButton.onClick(backButtonCallback.current);
        tg.BackButton.show();
    };

    /** Hide BackButton */
    const hideBackButton = () => {
        if (backButtonCallback.current) {
            tg.BackButton.offClick(backButtonCallback.current);
            backButtonCallback.current = null;
        }
        tg.BackButton.hide();
    };

    /**
     * MainButton Loader
     * @param state
     * @returns {void}
     */
    const setLoaderMainButton = (state) => {
        if (state) {
            tg.MainButton.showProgress()
        } else {
            tg.MainButton.hideProgress()
        }
    }


    /**
     * Close App
     * @returns {void}
     */
    const closeApp = () => {
        tg.close();
    };

    /**
     * Open Payment
     * @param url
     * @param callback
     * @returns {Promise<void>}
     */

    const openInvoice = async (url, callback) => {
        await tg.openInvoice(url, callback);
    };

    /**
     * Vibrate
     * @param style
     * @returns {void}
     */
    const vibrate = (style) => {
        switch (style) {
            case 'light':
            case 'medium':
            case 'heavy':
            case 'rigid':
            case 'soft':
                tg.HapticFeedback.impactOccurred(style)
                break
            case 'error':
            case 'warning':
            case 'success':
                tg.HapticFeedback.notificationOccurred(style)
                break
        }
    };

    /**
     * @param title
     * @param message
     * @param buttons
     * @returns {Promise<void>}
     */
    const showPopup = (title, message, buttons = [{id: 'ok', text: 'OK'}]) => {
        tg.showPopup({
            title: title,
            message: message,
            // buttons: buttons
        });
    };

    return {
        vibrate,
        isValid,
        initData,
        closeApp,
        showPopup,
        getPlatform,
        openInvoice,
        showMainButton,
        hideMainButton,
        showBackButton,
        hideBackButton,
        setLoaderMainButton,
        setDisabledMainButton
    };
}
