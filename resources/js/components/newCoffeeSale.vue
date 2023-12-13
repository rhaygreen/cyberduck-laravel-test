<template>
    <div>
      <Vueform columns="16">

        <TextElement
            :columns="{ container: 3, label: 12, wrapper: 12 }"
            :attrs="{ autofocus: true }"
            name="quantity"
            id="quantity"
            size="md"
            label="Quantity"
            placeholder="Enter quantity"
        />

        <TextElement
            :columns="{ container: 3, label: 12, wrapper: 12 }"
            name="unit_cost"
            id="unit_cost"
            size="md"
            label="Unit Cost (£)"
            placeholder="Enter unit cost"
        />

        <TextElement
            :readonly="true"
            :columns="{ container: 3, label: 12, wrapper: 12 }"
            name="selling_price"
            id="unit_cost"
            size="md"
            label="Selling Price"
         />

        <ButtonElement
            :columns="{ container: 3, label: 12, wrapper: 12 }"
            name="record_sale"
            id="record_sale">Record Sale</ButtonElement>
        <StaticElement
            :columns="12"
            name="divider"
            tag="hr"
        />
      </Vueform>
    </div>
  </template>
