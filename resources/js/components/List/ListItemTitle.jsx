import React from "react";

const ListItemTitle = ({title, subTitle}) => {
    return (
        <h3 className={'list__item-title text-color'}>
            {subTitle && (<span className="list__item-subtitle subtitle-color">{subTitle}</span>)}
            {title}
        </h3>
    );
}

export default ListItemTitle;
