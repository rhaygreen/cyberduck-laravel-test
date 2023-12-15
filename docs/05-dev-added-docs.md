Currency is assumed to be GBP. Would be fine other base 100 currencies. Haven't tested for others.

DB schema currently allows for multiple products per sale. This is a requirement at this stage,
but seemed like a sensible thing to do.

Shipping cost is currently assciated with a product. It could be per product, per sale, per customer, or something else.

I've kept the selling price calcualtion logic on the backend because:
1. It means there is a single source of truth - avoids one calculation in PHP and another in JS
2. Given we don't trust user input, the calculation would always need to be done on the server before saving the record.

Areas for improvement - Part one
1. Large numbers are not currently displayed in the 'existing sales' table with comma separated thousands.
2. There is no front end / UI testing. Something like Laravel Dusk would be an option here.
3. Error messages are all in 'alert' dialogues, some sort of modal or error messages displayed under the appropriate fields would be better.
4. Whilst there are error messages when calculating the selling price, there is currently nothing if the user clicks the 'Record Sale' with invalid data. The back end will generate errors, but the front end currently has no way to display these. 
5. Some sort of flash 'confirmation' message when a sale is successfully recorded.

Part 2
1. Responses from the server for existing sales is returning more data than required.
2. Request for selling price should be JSON formatted, currenctly it is just plain text.
3. Dates and time are controlled by the server. Ideally, the code would ensure these are in UTC.
4. Pagination on the 'existing coffee sales' table would be useful.

