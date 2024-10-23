import './List.scss';
import React, {Fragment, useState} from 'react';

import Badge from "../Badge";
import ListItemImg from "./ListItemImg";
import ListItemDrop from "./ListItemDrop";
import ListItemTitle from "./ListItemTitle";
import ListItemDropArrow from "./ListItemDropArrow";

const defaultCallBack = () => {
};

const ListItem = (
    {
        id,
        img = '',
        type = '',
        title = '',
        subTitle = '',
        children = '',
        total = false,
        dropDown = false,
        items = [],
        onClick = defaultCallBack,
        handleCheckBox = defaultCallBack,
        handleInputRange = defaultCallBack
    }) => {

    const [active, setActive] = useState(false);

    const activeClass = active ? 'active' : '';
    const cursorClass = dropDown ? 'cursor' : '';

    return (
        <Fragment>
            <div
                onClick={() => {
                    onClick(id);
                    setActive(!active);
                }}
                className={`list__item ${cursorClass}`}>

                {img && <div className={'list__item-left'}>
                    <ListItemImg img={img} title={title}/>
                </div>}

                <div className="list__item-right border-bottom-color">
                    {title && <ListItemTitle title={title} subTitle={subTitle}/>}
                    <Badge total={total}/>
                    {dropDown && <ListItemDropArrow activeClass={activeClass}/>}
                    {children}
                </div>
            </div>

            {/*DropDown*/}
            {dropDown && <ListItemDrop
                type={type}
                parentId={id}
                items={items}
                activeClass={activeClass}
                handleCheckBox={handleCheckBox}
                handleInputRange={handleInputRange}
            />}

        </Fragment>
    );
};

export default ListItem;
