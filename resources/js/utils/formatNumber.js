export const formatNumber = (value) => {
    if (!value) return '';
    value = String(value);
    const number = value.replace(/\D/g, '');
    return number.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
};
