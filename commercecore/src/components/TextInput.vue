<template>
<div class='my-2'>
    <div class='border rounded flex items-center w-full outline-none hover:outline-none focus:outline-none active:outline-none mb-1'
        :class="{ 'border-blue-300': isActive, 'border-red-500 field-error': hasError && !isActive }">
        <input class='py-3 px-3 w-full outline-none hover:outline-none focus:outline-none active:outline-none rounded' 
            :bind='value' @input="$emit( 'input', $event.target.value )"
            :placeholder='placeholder' @focus="() => isActive = true" @blur="() => isActive = false">
        <div v-if='icon' class='px-2'>
            <i :class='icon'/>
        </div>
    </div>
    <slot></slot>
</div>
</template>

<script>
export default {
    name: 'TextInput',
    props: [ 'value', 'icon', 'placeholder', 'hasError' ],

    data: () => ({
        isActive: false
    })
}
</script>

<style scoped>
.field-error {
    box-shadow: 0 0 7px rgba( 210, 10, 80, 0.3 );
}
</style>