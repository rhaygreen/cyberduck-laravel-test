<script>
import { ButtonElement } from '@vueform/vueform';
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
            if(this.data.product_id == null){
                alert('Please select a product');
                return false;
            }
            if(!isNaN(parseFloat(this.data.quantity)) && !isNaN(parseFloat(this.data.unit_cost))) {
                const url = '/product/'+this.data.product_id+'/calculateSellingPrice?quantity='+this.data.quantity+'&unit_cost='+this.data.unit_cost
                try {
                    await axios.get(url)
                    .then((response) => this.data.selling_price = response.data )
                }catch(error) {
                    alert(error.response.data.message)
                    console.log(error.response.data.errors);
                }
            }
        },
        async recordSale() {
            if(this.data.product_id == null){
                alert('Please select a product');
                return false;
            }
            if(!isNaN(parseFloat(this.data.quantity)) && !isNaN(parseFloat(this.data.unit_cost))) {
                //add debounce to the button. Remove once request returns.
                this.data.button_disabled = true;
                this.button.text = 'Recording...';

                const url = '/sale/store';
                try {
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
                        //emit event so table of existing sales knows to update
                        this.$emit('sale-made', now.valueOf())
                        alert('Sale recorded successfully');
                    })
                }catch(error) {
                    alert(error.response.data.message)
                    console.log(error.response.data.errors);
                    this.data.button_disabled = false;
                    this.button.text = 'Record Sale';
                }
            }
            else {
                //@todo this would be better as a modal
                alert('Please provide valid quantity and unit costs. Both must be numbers, decimals are allowed.');
            }
        },
        blankFields() {
            this.data.quantity = '';
            this.data.unit_cost = '';
            this.data.selling_price = '';
        }
    }

};

</script>

<template>
    <div>
      <Vueform columns="20" v-model="data" sync>
        <SelectElement
            :columns="{ container: 2, label: 12, wrapper: 12 }"
            :native="false"
            size="md"
            label="Product"
            name="product_id"
            id="product_id"
            items="/products"
            :on-change="blankFields"
        />
        <TextElement
            :columns="{ container: 2, label: 12, wrapper: 12 }"
            :attrs="{ autofocus: true }"
            name="quantity"
            id="quantity"
            size="md"
            label="Quantity"
            v-model="quantity"
            v-on:input="loadPrice"
        />

        <TextElement
            :columns="{ container: 2, label: 12, wrapper: 12}"
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
            :columns="{ container: 2, label: 12, wrapper: 12 }"
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
            style="margin-top:29px"
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
