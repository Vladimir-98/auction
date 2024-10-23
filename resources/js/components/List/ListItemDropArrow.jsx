import React, {Fragment} from "react";

const ListItemDropArrow = ({activeClass}) => {

    return (
        <Fragment>
            <div className={`list__item-arrow ${activeClass}`}>
                <svg className={'stroke-color'} fill="none" version="1.1" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path d="m29.76 11.167-13.754 12.143-13.754-12.143"/>
                </svg>
            </div>
        </Fragment>
    );
}

export default ListItemDropArrow;
