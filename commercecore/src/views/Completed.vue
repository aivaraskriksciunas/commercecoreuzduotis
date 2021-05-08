<template>
<div class='flex justify-center'>
<div class='w-1/2 py-4 text-center px-4 bg-white rounded-lg mt-8 shadow-lg'>{{ message }}</div>
</div>
</template>

<script>
import OrderState from '../orderState'

export default {
    name: 'Completed',

    data: () => ({
        message: ""
    }),

    created() {
        this.message = OrderState.message
    }
}
</script>