import React, {Fragment} from "react";

import CheckBox from "../Forms/CheckBox";
import RangeInput from "../Forms/RangeInput";
import {INPUT_TYPES} from "../../constants/inputConstancts";

const ListItemDrop = (
    {
        type,
        items,
        parentId,
        activeClass,
        handleCheckBox,
        handleInputRange
    }) => {

    return (
        <Fragment>

            <div className={`list__item-dropdown ${activeClass}`}>
                <div className="list__item-dropdown-list">
                    {items && (
                        type === INPUT_TYPES.CHECKBOX && (
                            items.map(item => (
                                <CheckBox
                                    name={item.name}
                                    active={item.active}
                                    key={item.name + item.id}
                                    onChange={(e) => handleCheckBox(parentId, item.id, e)}
                                />
                            ))
                        )
                    )}

                    {/*Input Range*/}
                    {type === INPUT_TYPES.RANGE_INPUT && (
                        <RangeInput
                            key={type + parentId}
                            onBlur={(min, max) => handleInputRange(parentId, min, max)}
                        />)
                    }
                </div>
            </div>
        </Fragment>
    );
}

export default ListItemDrop;
