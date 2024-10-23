import './Badge.scss'
import React, {Fragment} from "react";

const Badge = ({total}) => {
    return (
        <Fragment>
            <div className={'badge badge-color text-color'}>{total}</div>
        </Fragment>
    );
}

export default Badge;
