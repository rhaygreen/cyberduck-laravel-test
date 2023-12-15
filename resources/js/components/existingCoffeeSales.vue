<script>
import axios from 'axios';
import watch from 'vue';

export default {
    props: {
        open: {
            type: String,
            default: ''
        },
        message: {
            type: String,
            default: ''
        },
    },
    data() {
        return {
            data: {
                sales: []
            },
        };
    },
    mounted() {
        this.fetchData();
    },
    watch: {
        message: function() {
            this.fetchData();
        }
    },
    methods: {
        async fetchData() {
            const url = '/sale'
                await axios.get(url)
                .then((response) => {
                    console.log(response.data);
                    this.data.sales = response.data

                })
                .catch(function (error){
                    alert('Sorry, something went wrong. Please try again');
                    console.log(error);
                });
        }
    }
};

</script>
<template>
    <h1>Existing coffee sales</h1>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Product</th>
                    <th scope="col" class="px-6 py-3">Quantity</th>
                    <th scope="col" class="px-6 py-3">Unit Cost</th>
                    <th scope="col" class="px-6 py-3">Selling Price</th>
                    <th scope="col" class="px-6 py-3">Sold at</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="sale in data.sales" :key="sale.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th v-text="sale.product_sales[0].product.name" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                </th>
                <td v-text="sale.product_sales[0].quantity" class="px-6 py-4">

                </td>
                <td v-text="'£' + Number(sale.product_sales[0].unit_cost.value).toFixed(2)" class="px-6 py-4">

                </td>
                <td v-text="'£' + Number(sale.product_sales[0].selling_price.value).toFixed(2)" class="px-6 py-4">

                </td>
                <td v-text="sale.product_sales[0].created_at" class="px-6 py-4">

                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
