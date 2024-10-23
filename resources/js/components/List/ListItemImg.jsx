import React from "react";

const ListItemImg = ({img, title}) => {
    return (
        <div className="list__item-img img-bg-color">
            <img src={img} alt={title}/>
        </div>
    );
}

export default ListItemImg;
