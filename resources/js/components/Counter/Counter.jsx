import React, {useEffect, useRef} from 'react';
import {formatNumber} from "../../utils/formatNumber";

const Counter = React.memo(({start, end, duration = 500}) => {
    const containerRef = useRef(null);

    useEffect(() => {
        if (typeof start !== 'number' || typeof end !== 'number' || duration <= 0) {
            console.error('Invalid input values.');
            return;
        }

        const increment = (end - start) / (duration / 1000 * 30);
        let current = start;

        const counter = setInterval(() => {
            current += increment;

            if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                current = end;
                clearInterval(counter);
            }

            let result = Math.round(current);
            if (containerRef.current) {
                containerRef.current.textContent = result ? formatNumber(result) : 0;
            }

        }, 1000 / 30);

        return () => clearInterval(counter);
    }, [start, end]);

    return <div style={{display: "inline-block"}} ref={containerRef}/>;
});

const areEqual = (prevProps, nextProps) => {
    return prevProps === nextProps && prevProps.end === nextProps.end;
};

export default React.memo(Counter, areEqual);
