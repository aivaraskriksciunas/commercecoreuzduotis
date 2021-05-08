<template src='./Main.html'>
</template>

<script>
import axios from 'axios'
import Product from '../components/Product.vue'
import TextInput from '../components/TextInput.vue'
import csc from 'country-state-city'
import { formatPrice } from '../helpers'
import { required, maxLength, minLength, between, minValue, numeric, email as isEmail } from 'vuelidate/lib/validators'
import OrderState from '../orderState'

export default {
    name: 'Main',
    components: {
        Product,
        TextInput,
    },

    data: () => ({
        isLoading: true,
        hasError: true,

        products: [],
        selected_product: null,
        delivery_cost: 1095,

        country_list: csc.getAllCountries(),
        state_list: [],
        city_list: [],

        warranty: false,

        orderErrorMsg: null,
        cardNumber: '',
        cardSecurityCode: '',
        expirationMonth: '',
        expirationYear: '',
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        address: '',
        city: '',
        country: '',
        state: '',
        postcode: '',
    }),

    async created() {
        let res = null 
        try {
            res = await axios.get( 'products' );
        }
        catch ( e ) {
            this.hasError = true;
            return;
        }
        this.products = res.data 
    },


    methods: {
        formatPrice,
        on_product_select( prod, warranty ) {
            this.warranty = warranty
            this.selected_product = prod
        },
        calculateTotal() {
            let total = this.selected_product.discounted_price * this.selected_product.amount
                + this.delivery_cost
            if ( this.warranty ) total += 999 * this.selected_product.amount 
            return total
        },
        getCountryInfo() {
            this.state_list = csc.getStatesOfCountry( this.country )
            this.city_list = csc.getCitiesOfCountry( this.country )
            this.state = ""
            this.city = ""
        },
        getStateInfo() {
            this.city_list = csc.getCitiesOfState( this.country, this.state )
            this.city = ""
        },

        async completePurchase( ) {
            this.$v.$touch()
            this.orderErrorMsg = null

            if ( this.$v.$invalid || !this.selected_product ) return;

            let response;
            try {
                response = await axios.post( 'import', {
                    product_id: this.selected_product.id,
                    card_number: this.cardNumber,
                    card_security_code: this.cardSecurityCode,
                    expiration_month: this.expirationMonth,
                    expiration_year: this.expirationYear,
                    first_name: this.firstName,
                    last_name: this.lastName,
                    email: this.email,
                    phone: this.phone,
                    address: this.address,
                    country: this.country,
                    state: this.state,
                    city: this.city,
                    postcode: this.postcode,
                    warranty: this.warranty,
                } )
            } catch ( e ) {
                this.orderErrorMsg = e.response.data.message || "Purchase failed. Please try again later"
                window.scrollTo( 0, 0 )
                return;
            }

            OrderState.message = response.data.message
            this.$router.push({ 'path': 'success' })
        },
    },

    validations: {
        cardNumber: {
            required,
            minLength: minLength( 16 ),
            maxLength: maxLength( 16 ), 
            numeric,
        },
        cardSecurityCode: {
            required,
            minLength: minLength( 3 ),
            numeric
        },
        expirationMonth: {
            required,
            between: between( 1, 12 ),
            numeric
        },
        expirationYear: {
            required,
            minValue: minValue( 21 ),
            numeric
        },
        firstName: {
            required,
        },
        lastName: {
            required,
        },
        email: {
            required,
            isEmail,
        },
        phone: {
            required,
        },

        address: {
            required,
        },
        city: {
        },
        country: {
            required,
        },
        state: {
        },
        postcode: {
            required,
        }

    }
    
}
</script>