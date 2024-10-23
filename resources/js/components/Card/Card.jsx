import './Card.scss'
import React from "react";
import {formatNumber} from "../../utils/formatNumber";

const Card = ({
                  id,
                  name,
                  leadPrice,
                  budget,
                  paymentType,
                  districts,
                  categories,
                  choice,
                  onClick,
                  skeleton = false
              }) => {

    const formatLeadPrice = formatNumber(leadPrice || '');

    return (
        <div
            onClick={onClick}
            className={'card card-bg-color' + (choice ? ' choice button-bg-color' : '') + (skeleton ? ' skeleton' : '')}>
            <div className={'card__content'}>
                <div className={'card__title'}>
                    <h4 className={'text-color'}>{name}</h4>
                </div>
                <div className={'card__description'}>
                    {categories && <p className={'subtitle-color'}>{categories}</p>}
                    {paymentType && <p className={'subtitle-color'}>{paymentType}</p>}
                    {districts && <p className={'subtitle-color'}>{districts}</p>}
                    {budget && <p className={'subtitle-color'}>{budget}</p>}
                </div>
            </div>
            <div className={'card__price'}>
                <div className={'card__price-lead-sum text-color'}>
                    {formatLeadPrice}
                </div>
                <div className={'card__price-lead-title subtitle-color'}>
                    цена лида
                </div>
            </div>
        </div>
    );
}

export default Card;
