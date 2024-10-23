import React, {Fragment} from "react";
import {useTelegram} from "../../hooks/useTelegram";

const CheckBox = ({name, active, onChange = () => {}}) => {

    const {vibrate} = useTelegram();

    return (
        <Fragment>
            <label
                onClick={() => vibrate('light')}
                className="checkbox"
            >
                <div className="checkbox-label text-color">{name}</div>
                <input
                    onChange={onChange}
                    type="checkbox"
                    checked={active}
                />
                <span/>
            </label>
        </Fragment>
    );
}

export default CheckBox;
