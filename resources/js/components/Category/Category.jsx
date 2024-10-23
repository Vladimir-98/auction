import ListItem from "../List";

import React, {Fragment} from "react";
import {useDispatch} from "react-redux";
import {useNavigate} from "react-router-dom";
import {ORDERS_ROUTE} from "../../constants/routesConstants";
import {setFilterActiveItem} from "../../reducers/filterReducer";
import {getCategoriesSelector} from "../../selectors/filterSelector";

const Category = () => {
    const navigate = useNavigate();
    const dispatch = useDispatch();
    const categories = getCategoriesSelector();

    const handleCategoryClick = (catId) => {
        dispatch(setFilterActiveItem(1, catId));
        navigate(ORDERS_ROUTE);
    };

    return (
        <Fragment>
            <div className={'list card-bg-color'}>
                {categories && categories.map(item =>
                    <ListItem
                        id={item.id}
                        img={item.img}
                        type={item.type}
                        title={item.name}
                        total={item.total}
                        key={item.name + item.id}
                        onClick={handleCategoryClick}
                    />)}
            </div>
        </Fragment>
    );
};

export default Category;
