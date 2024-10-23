import React, {useState} from "react";

import {formatNumber} from '../../utils/formatNumber';

const RangeInput = ({onBlur}) => {

    const [inputMin, setInputMin] = useState();
    const [inputMax, setInputMax] = useState();

    const formattedMin = formatNumber(inputMin || '');
    const formattedMax = formatNumber(inputMax || '');

    return (
        <div className={'form-group'}>
            <input
                type={'text'}
                className={'form-control range-input bg-color text-color'}
                placeholder={'0'}
                value={formattedMin}
                onChange={(e) => setInputMin(e.target.value)}
                onBlur={(e) => onBlur(e.target.value, inputMax)}
            />
            <span className="range-input__label subtitle-color">-</span>
            <input
                type={'text'}
                className={'form-control range-input bg-color text-color'}
                placeholder={'1 000 000'}
                value={formattedMax}
                onChange={(e) => setInputMax(e.target.value)}
                onBlur={(e) => onBlur(inputMin, e.target.value)}
            />
        </div>
    );
};

export default RangeInput;
