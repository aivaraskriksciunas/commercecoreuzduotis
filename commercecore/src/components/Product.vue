<template>
<div class='border rounded overflow-hidden mb-8  cursor-pointer'
    @click="selected"
    :class="{ 'bg-blue-100 hover:bg-blue-200': is_selected, 'hover:bg-purple-100': !is_selected }">

<div class='px-3 py-2 flex bg-gray-600 text-white'
    :class="{ 'bg-purple-900': is_selected }">
    <div class='w-1/3'>
        {{ product.title }}
    </div>
    <div class='w-1/3'>
        <span class='bg-green-600 uppercase text-sm py-1 px-2 mr-2' v-if='product.discount > 0'>
            {{ product.discount }}% Off
        </span>
        <span class='bg-red-600 uppercase text-sm py-1 px-2' v-if='product.json_options.best_seller'>
            Best seller
        </span>
    </div>

    <div class='w-1/3 text-right'>
        <i class="fas fa-truck mr-2"></i> Fast delivery
    </div>
</div>

<div class='flex px-8'>
    <div class='w-3/4'>
        <img :src="product.image_url || 'https://cdn.taggdigital.com/webroot/img/756191611526140.png'"
            class='product-image' />
    </div>
    <div class='w-1/4 py-8'>
        <div class='border-b'>
            <span class='text-4xl'>
                {{ formatPrice( product.discounted_price ) }}
            </span>
            <span class='text-gray-600 text-md'>
                /each
            </span>
        </div>

        <div class='text-red-700 my-2'>
            Orig {{ formatPrice( product.unit_price_usd * product.amount ) }}
        </div>
        <div class='text-gray-600 text-sm my-2'>
            Total {{ formatPrice( product.discounted_price * product.amount ) }}
        </div>
    </div>
</div>

<div v-if='is_selected'>
    <div class='bg-yellow-100 px-3 py-1'>
        <label class='flex items-center' @click.stop='warrantyChanged'>
            <input type='checkbox' class='mr-2' v-model='warranty' >
            Yes, I Want Lifetime Protection
        </label>
    </div>
    <p class='px-3 py-2 bg-white'>
        <span class="font-bold">One time offer:</span> By placing an order today, you can have lifetime protection and replacement warranty for only an additional $9.99 per unit 
    </p>
</div>

<div class='border-t flex justify-around px-2 py-2 text-sm bg-white'>
    <div class=''>
        Sell out risk: <span class='text-red-500 font-medium'>High</span>
    </div>
    <div class='text-green-600'>
        Fast delivery 
    </div>
    <div class=''>
        Discount {{ product.discount }}%
    </div>
    <div class=''>
        <i class="fas fa-signal mr-2"></i>
        <span v-if='product.json_options.popularity == 1'>Moderate</span>
        <span v-if='product.json_options.popularity == 2'>Popular</span>
        <span v-if='product.json_options.popularity == 3'>Best seller</span>
    </div>
</div>
</div>
</template>

<script>
import { formatPrice } from '../helpers'

export default {
    name: 'Product',

    props: [ 'product', 'is_selected' ],
    

    data: () => ({
        warranty: false
    }),

    methods: {
        formatPrice,
        selected() {
            this.$emit( 'selected', this.product, this.warranty )
        },
        warrantyChanged() {
            this.$emit( 'selected', this.product, !this.warranty )
        }
    }
}
</script>


<style scoped>
.product-image {
    max-height: 150px;
}
</style>