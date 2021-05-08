
export const getDollars = ( price ) => Math.floor( price / 100 )
export const getCents =   ( price ) => price % 100
export const formatPrice =( price ) => `$${getDollars(price)}.${getCents(price)}`