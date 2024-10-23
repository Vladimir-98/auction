import React from "react";

import {formatNumber} from '../../utils/formatNumber';

const Input = ({id, inputType, label, value = '', placeholder = '0', onChange = () => {}}) => {

    const formattedValue = inputType === 'number' ? formatNumber(value || '') : value;

    return (
        <div className={'form-group'}>
            <label className={'form-label text-color'}>{label}</label>
            <input
                type={'text'}
                className={'form-control input bg-color text-color'}
                placeholder={placeholder}
                value={formattedValue}
                onChange={(e) => onChange(id, e.target.value)}
            />
        </div>
    );
};

export default Input;
