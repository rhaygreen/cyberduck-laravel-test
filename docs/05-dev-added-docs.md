Currency is assumed to be GBP. Would be fine other base 100 currencies. Haven't tested for others.

DB schema currently allows for multiple products per sale. This is a requirement at this stage,
but seemed like a sensible thing to do.

Shipping cost is currently assciated with a product. It could be per product, per sale, per customer, or something else.

I've kept the selling price calcualtion logic on the backend because:
1. It means there is a single source of truth - avoids one calculation in PHP and another in JS
2. Given we don't trust user input, the calculation would always need to be done on the server before saving the record.

