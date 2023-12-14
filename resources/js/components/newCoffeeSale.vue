<script>
import axios from 'axios';

export default {
  data() {
    return {
        data: {
            product_id: 1,
            quantity: '',
            unit_cost: '',
            selling_price: ''
        }
    };
  },
  methods: {
    async loadPrice() {
        this.data.selling_price = '';
        if(!isNaN(parseFloat(this.data.quantity)) && !isNaN(parseFloat(this.data.unit_cost))) {
            const url = '/product/1/quantity/'+this.data.quantity+'/unitprice/'+this.data.unit_cost
            //@todo this requires error handling.
            await axios.get(url).then((response) => this.data.selling_price = response.data );
        }
    },
    async recordSale() {
        if(!isNaN(parseFloat(this.data.quantity)) && !isNaN(parseFloat(this.data.unit_cost))) {
            alert('success');
        }
        else {
            //@todo this would be better as a vue form modal
            alert('Please provide a quantity and unit price');
        }
    }
  }

};

</script>

<template>
    <div>
      <Vueform columns="16" v-model="data" sync>
        <HiddenElement name="product" value="1" v-model="product_id"/>
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
            :columns="{ container: 3, label: 12, wrapper: 12 }"
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
            :columns="{ container: 3, label: 12, wrapper: 12 }"
            name="record_sale"
            id="record_sale"
            @click="recordSale"
            >Record Sale
        </ButtonElement>
        <StaticElement
            :columns="12"
            name="divider"
            tag="hr"
        />
      </Vueform>
    </div>
  </template>
