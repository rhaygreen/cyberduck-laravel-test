Currency is assumed to be GBP. Would be fine other base 100 currencies. Haven't tested for others.

DB schema currently allows for multiple products per sale. This is a requirement at this stage,
but seemed like a sensible thing to do.

Shipping cost is currently assciated with a product. It could be per product, per sale, per customer, or something else.

I've kept the selling price calcualtion logic on the backend because:
1. It means there is a single source of truth - avoids one calculation in PHP and another in JS
2. Given we don't trust user input, the calculation would always need to be done on the server before saving the record.

Both the quanity and unit cost fields will allow up to 6 decimal places, as the products
could be sold in very small quantities or in proced in souch a way that this level of precision
is required. 

Areas for improvement - Part one
1. Large numbers are not currently displayed in the 'existing sales' table with comma separated thousands.
2. There is no front end / UI testing. Something like Laravel Dusk would be an option here.
3. Error messages are all in 'alert' dialogues, some sort of modal or error messages displayed under the appropriate fields would be better.
4. Some sort of flash 'confirmation' message when a sale is successfully recorded, as opposed to the current 'alert' dialogue.

Part 2
1. Responses from the server for existing sales is returning more data than required. Ideally
an API resposne should only contain the required data.
2. Dates and time are controlled by the server. Ideally, the code would ensure these are in UTC.
3. Pagination on the 'existing coffee sales' table would be useful.

