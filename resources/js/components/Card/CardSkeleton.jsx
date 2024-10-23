import './Card.scss'

import React from 'react';
import Card from "./Card";

const CardSkeleton = (id = 1) => {
    return (
            <Card
                id={id}
                name={'------------------'}
                leadPrice={'2000'}
                budget={'100000000'}
                paymentType={'--------'}
                districts={'-------------'}
                categories={'-------------------------'}
                choice={false}
                onClick={() => {}}
                skeleton={true}
            />
    )
}

export default CardSkeleton;
