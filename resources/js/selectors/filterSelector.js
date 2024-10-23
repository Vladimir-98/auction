import {useSelector} from "react-redux";


export const getCategoriesSelector = () => {
    const filter = useSelector(state => state.filter);
    const categories = filter.items.find(item => item.id === 1);
    return categories?.items
}

export const getFilterData = (filters) => {

    return filters.reduce((acc, filter) => {

        if (filter.items.hasOwnProperty('min') || filter.items.hasOwnProperty('max')) {
            if (filter.items.min !== null || filter.items.max !== null) {
                acc[filter.name] = filter.items;
            }
        } else {
            const activeItems = filter.items.filter(item => item.active).map(item => item.id);

            if (activeItems.length > 0) {
                acc[filter.name] = activeItems;
            }

        }

        return acc;

    }, {});
};

