<script>
import newCoffeeSale from './newCoffeeSale.vue';
import existingCoffeeSales from './existingCoffeeSales.vue';

export default {
        components: {newCoffeeSale, existingCoffeeSales},

        data() {
            return {
                thecardtitle: 'Parent Component!',
                message: ''
            }
        },

        methods: {
            messageExistingSales(message) {
                this.message = message;
            }
        }
}

</script>


<template>
    <div>
        <new-coffee-sale @sale-made="messageExistingSales($event)"></new-coffee-sale>
    </div>
    <div>
        <existing-coffee-sales :message="message"></existing-coffee-sales>
    </div>
</template>
