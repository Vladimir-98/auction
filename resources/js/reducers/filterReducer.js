import {INPUT_TYPES} from "../constants/inputConstancts";

const UPDATE_FILTER = 'UPDATE_FILTER';
const SET_FORM_DATA = 'SET_FORM_DATA';
const UPDATE_MIN_MAX = 'UPDATE_MIN_MAX';
const TOGGLE_FILTER_ACTIVE = 'TOGGLE_FILTER_ACTIVE';
const SET_FILTER_ACTIVE_ITEM = 'SET_FILTER_ACTIVE_ITEM';
const TOGGLE_FILTER_ITEM_ACTIVE = 'TOGGLE_FILTER_ITEM_ACTIVE';

const initialState = {
    items: [],
    formData: null
}

const filterReducer = (state = initialState, action) => {
    let newFilter = [];

    switch (action.type) {
        case TOGGLE_FILTER_ACTIVE:

            newFilter = state.items.map(item =>
                item.id === action.itemId ? {...item, active: !item.active} : item
            );

            return {
                ...state,
                items: newFilter
            };

        case TOGGLE_FILTER_ITEM_ACTIVE:
            newFilter = state.items.map(filter => {
                if (filter.id === action.parentId) {
                    return {
                        ...filter,
                        items: filter.items.map(subItem =>
                            subItem.id === action.subItemId
                                ? {...subItem, active: !subItem.active}
                                : subItem
                        )
                    };
                }
                return filter;
            });

            return {
                ...state,
                items: newFilter
            }

        case UPDATE_MIN_MAX:

            newFilter = state.items.map(filter => {

                if (filter.id === action.parentId) {
                    return {
                        ...filter,
                        items: {min: action.min, max: action.max},
                    };
                }
                return filter;
            });

            return {
                ...state,
                items: newFilter
            }

        case SET_FILTER_ACTIVE_ITEM:

            newFilter = state.items.map(filter => {
                const isCategoryFilter = filter.id === action.parentId;
                let updatedItems;

                if (filter.type === INPUT_TYPES.RANGE_INPUT) {
                    updatedItems = {
                        ...filter.items,
                        min: null, max: null
                    };

                } else {
                    updatedItems = filter.items.map(item => {
                        return {
                            ...item,
                            active: isCategoryFilter && item.id === action.itemId
                        };
                    });
                }

                return {
                    ...filter,
                    active: false,
                    items: updatedItems
                };
            });

            return {
                ...state,
                items: newFilter
            }

        case UPDATE_FILTER:
            return {
                ...state,
                items: action.filter
            };

        case SET_FORM_DATA:
            return {
                ...state,
                formData: action.formData
            };

        default:
            return state;
    }
};

export const updateFilter = (filter) => ({type: UPDATE_FILTER, filter});
export const toggleFilterActive = (itemId) => ({type: TOGGLE_FILTER_ACTIVE, itemId});
export const setFilterActiveItem = (parentId, itemId) => ({type: SET_FILTER_ACTIVE_ITEM, parentId, itemId});
export const updateMinMax = (parentId, min, max) => ({type: UPDATE_MIN_MAX, parentId, min, max});
export const setFormData = (formData) => ({type: SET_FORM_DATA, formData});

export const toggleFilterItemActive = (parentId, subItemId) => ({
    type: TOGGLE_FILTER_ITEM_ACTIVE,
    parentId,
    subItemId
});

export default filterReducer;
