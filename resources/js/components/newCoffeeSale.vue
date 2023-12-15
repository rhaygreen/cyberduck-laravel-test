<script>
import axios from 'axios';

export default {
    props: {
        product_id: {
            type: String,
            default: ''
        },
        quantity: {
            type: String,
            default: ''
        },
        unit_cost: {
            type: String,
            default: ''
        },
        selling_price: {
            type: String,
            default: ''
        },
        button_disabled: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            data: {
                product_id: 1,
                quantity: '',
                unit_cost: '',
                selling_price: '',
                button_disabled: false
            },
            button: {
                text: 'Record Sale'
            },
        };
    },
    methods: {
        async loadPrice() {
            this.data.selling_price = '';
            if(!isNaN(parseFloat(this.data.quantity)) && !isNaN(parseFloat(this.data.unit_cost))) {
                const url = '/product/'+this.data.product_id+'/calculateSellingPrice?quantity='+this.data.quantity+'&unit_cost='+this.data.unit_cost
                await axios.get(url)
                .then((response) => this.data.selling_price = response.data )
                .catch(function (error){
                    alert('Sorry, something went wrong. Please try again');
                    console.log(error);
                });
            }
        },
        async recordSale() {
            if(!isNaN(parseFloat(this.data.quantity)) && !isNaN(parseFloat(this.data.unit_cost))) {
                //add debounce to the button. Remove once request returns.
                this.data.button_disabled = true;
                this.button.text = 'Recording...';

                const url = '/sale/store';
                await axios.post(url,{
                    id_product: this.data.product_id,
                    quantity: this.data.quantity,
                    unit_cost: this.data.unit_cost

                })
                .then((response) => {
                    this.data.button_disabled = false;
                    this.button.text = 'Record Sale';
                    //ensure the message has a unique timestamp, so recieving components know it has changed
                    let now = new Date();
                    this.$emit('sale-made', now.valueOf())
                })
                .catch((error) => {
                    alert('Sorry, something went wrong. Please try again');
                    console.log(error);
                    this.data.button_disabled = false;
                    this.button.text = 'Record Sale';
                });
            }
            else {
                //@todo this would be better as a modal
                alert('Please provide valid quantity and unit costs. Both must be numbers, decimals are allowed.');
            }
        }
    }

};

</script>

<template>
    <div>
      <Vueform columns="16" v-model="data" sync>
        <HiddenElement name="product_id" value="1" v-model="product_id"/>
        <TextElement
            :columns="{ container: 3, label: 12, wrapper: 12 }"
            :attrs="{ autofocus: true }"
            name="quantity"
            id="quantity"
            size="md"
            label="Quantity"
            v-model="quantity"
            v-on:input="loadPrice"
        />

        <TextElement
            :columns="{ container: 3, label: 12, wrapper: 12}"
            :add-class="{
            input: 'pt-6'
            }"
            name="unit_cost"
            id="unit_cost"
            size="md"
            label="Unit Cost (£)"
            v-model="unit_cost"
            v-on:input="loadPrice"
        />

        <TextElement
            :readonly="true"
            :columns="{ container: 3, label: 12, wrapper: 12 }"
            name="selling_price"
            id="selling_price"
            size="md"
            label="Selling Price"
            v-model="selling_price"
         />

        <ButtonElement
            :columns="{ container: 2, label: 12, wrapper: 12 }"
            name="record_sale"
            id="record_sale"
            :disabled="button_disabled"
            @click="recordSale"
            >{{ button.text }}
        </ButtonElement>
        <StaticElement
            :columns="12"
            name="divider"
            tag="hr"
        />
      </Vueform>
    </div>
  </template>
