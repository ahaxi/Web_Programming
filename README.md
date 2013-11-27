Web_Programming
========================
This is the final project for my CSE 252 Web Programming course.
Two other teammates: Guanjie Xie, Ziliang Yuan
I wrote the php programming part except css.
Here is our final report.

We chose to make a computer parts web application for our final project. This web application is formed by 2 major parts; Front end and Back end. The front end is facilitated with PHP while the back end is supported by mysql.

Front End: 

- Index page: This page redirects the user to the “welcome.php” page.

- Welcome page: This is where to begin with. User can have a glance at different categories here and proceed further into details of each category by clicking on a certain category for example “CPU”. One thing here needs to be noted is that the sub-pages of each category and the individual page for each product is supported and created by “createC.php” and “createPHP.php” files respectively; which means those two files need to be ran from easlnx01 command line by typing “php5 <filename>” when the system admin use this application at first time . 

- User login page: Customer login page. Please be advised that customers can check out the products he selected only if he successfully logged in.

- User Registration page: This page is used for the new user registration. As mentioned above, customers cannot proceed to checkout unless he is legally logged in.
 
- Summary page: This page gives customer a clear view of the products in their shopping cart in terms of the product category, product name, product number, quantity, the total price for each product as well as the total price for all products which have been selected. Besides viewing the products info, customers are also eligible to edit and quantity of the products and system would update the product info dynamically according to the changes made by the customer. After this gets done, customer can either choose to click confirm which leads to the product confirmation page or just simply click on cancel button to cancel the order and close the window.


- Confirmation page: This is page gives customer a final updated view about the products have been selected



Back End:

As mentioned in the introduction, mysql is used for data storing in this web application. Underneath is the database structure for this application.

- xieg_useraccount : This table is used to store our customers’ account information. There are 3 attributes in this table: 
1.	userid: Generates account’s and store it automatically when a new account has been created
2.	username: Stores the username which user entered at process of registration.
3.	password: Stores the password which user entered at process of registration.

- xieg_cpus: 
There are 5 attributes in this table:
1.	id: Stores the product id.
2.	name: Stores the product name
3.	price: Stores the price
4.	quantity: Stores the quantity
5.	description: Store a brief description for the product

- xieg_monitors: The structure is identical with the table above.
- xieg_motherboard: The structure is identical with the table above.
- xieg_memory: The structure is identical with the table above.


Server Side Algorithms:
PHP script is implemented on the server side in order to better serve the following areas:
       Login page: PHP script Info validation is implemented here when user tries to login. User’s input will be got from the page and then do a cross reference with the account’s info in the database. It they do match, then take the user into the next page. Else, return an error and inform the user to check his input and enter them again.

Products, Summary,
And Confirmation
page:         

i.	We used session variables to transfer data from pages to pages. Start from the individual product page which has the detail description, and pictures, when one hits "add to cart", we write in the information in session variable as an associative array. The key is the category name "cpu","memory", etc, For each individual record we store an array in an order of "Item name, price, item number, quantity people choose", and integrate all the items selected in the same category into an big array. And this big array is corresponding to the category key.
The structure of the session variable is as 
session variable( "cpu"=> 
array(
[0]=> array(item1,price1,number1,quantity1)
[1]=>array(item2,price2,number2,quantity2)
)
"memory"=>(
array(
[0]=> array(item1,price1,number1,quantity1)
)
)
ii.	  The detail algorithm of assign this associative variable:
When the category is not an array key, means nothing has been selected from this category, assign the key and add the array into the key value. If there is an array key, then means there are records in it. Grab the value and loop through all the items records in it. If we can find the same item already there, we just change the quantity in the array (index 3), if there are no, then we use array_push to add a new array into this value array.
So people can hit add to cart many times and it will increase as the number he/she select in the drop box.

iii.	   In the confirmation page, we also use session variables.             As people might change their quantity to 0 or somehow change their value to string, which we think we need to take this as zero. So we first exam through  the quantity people have in the textbox of the summary page and get rid of the string and 0 data and get a refined session variable to then write them into table.

Client Side Algorithms:
JavaScript is implemented on the client side in order to better serve the following area:
       Summary Page:
1.	In the summary page. If you enter a number that is not integer, the program will round that for you. If you enter an string, then the program will prompt up an window ask you for valid number. The one you entered as an string will show up as "NAN", but the cost for that item will be 0. But if you hit confirm. The system will not take your original record. Since the show up on the total record is 0. The one you entered as string will be deleted.
2.	Detail Algorithm: In the summary page, we use javascript to make the record change immediately on moving off the cursor. The algorithm is we write javascript function to take the value of this on the blur, which is the quantity, and the price and an id that correspond to item's total value in. If there is double number, we will round it.  If otherwise people enter a string, we will prompt up a small window to inform this, and change this item's total cost to zero. The algorithm of change the total cost is after the change of the selected item's total cost, loop through all the item's total cost and add them together to update the total cost.

3.	Also, in the summary page, when the user clicks on the cancel button, this would triggers an javascript function to close the window and destroy the session variable without any warning. However, Please be noted that this function is only tested with IE 8.0 and Safari. If you are trying to perform this function by using Firefox, underneath are the steps to make it work:
a)	Enter “about:config” in your browser and hit enter, then click yes.
b)	Enter ”dom.allow_scripts_to_close_windows“ in the filter and double click it to change its value to true.
c)	Then you are all set.
d)	Other things: Please note that when the window has been closed when you hit “cancel”, but we would like you to close the browser to delete the session. 


