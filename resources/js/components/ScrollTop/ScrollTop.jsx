import {useEffect} from "react";
import {useLocation} from "react-router-dom";

const ScrollTop = () => {
    const location = useLocation();

    useEffect(() => {
        const bodyElement = document.querySelector('.scroll');
        if (bodyElement) {
            bodyElement.scrollIntoView({behavior: 'smooth', block: 'start'});
        }
    }, [location.pathname]);

    return null;
};

export default ScrollTop;
