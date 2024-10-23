import ListItem from "../List";
import React, {Fragment} from "react";
import {useDispatch, useSelector} from "react-redux";
import {toggleFilterItemActive, updateMinMax} from "../../reducers/filterReducer";

const Filter = () => {
    const dispatch = useDispatch();
    const {items} = useSelector(state => state.filter);

    const handleCheckBox = (parentId, subItemId) => {
        dispatch(toggleFilterItemActive(parentId, subItemId));
    }

    const handleInputRange = (parentId, min, max) => {
        dispatch(updateMinMax(parentId, min, max));
    }

    return (
        <Fragment>
            <div className={'list scroll card-bg-color small'}>
                {items.length > 0 && items.map(({id, type, name, title, items, dropDown}) =>
                    <ListItem
                        id={id}
                        type={type}
                        title={title}
                        items={items}
                        key={name + id}
                        dropDown={dropDown}
                        handleCheckBox={handleCheckBox}
                        handleInputRange={handleInputRange}
                    />
                )}
            </div>
        </Fragment>
    );
}

export default Filter;
