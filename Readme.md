
 
URL for Project YouTube Video
YouTube video: https://youtu.be/T3AMKxCvy4k
Entity Relationship Diagram
Conceptual design
 

![image](https://user-images.githubusercontent.com/87567247/214451029-1e1faade-e1c7-4eda-ad94-32899d6fb719.jpeg)

Assumptions on ER diagram:

•	There will be three types of users and an admin: sellers, buyers and both.
•	Both type accounts can do everything buyer and seller can do.
•	Sellers can create auctions for items, setting conditions such as the item description, categorization, starting price, reserve price, and end date.
•	Buyers can search for and browse items being auctioned and can bid on them.
•	Buyer cannot sell item
•	Seller cannot bid on its own item
 

 


Logical design
 
Database Schema
A database schema is the structure of a database, which describes the organisation and format of the data stored in the database. It refers to the tables, columns, triggers, relationships, key constraints, functions and procedures. An Entity-Relationship (ER) diagram is a visual representation of the database schema that shows the relationships between the different entities in the database. It includes column names and the cardinality of the relationship that exist between the columns (one-to-one, one-to-many, many-to-many).
For the ER diagram and schema, the primary and foreign keys are shown using the {PK} and {FK} symbols. Below is a detailed description of the attributes and attribute type for each table. An analysis on the relationships between the tables are also discussed



<img width="156" alt="image" src="https://user-images.githubusercontent.com/87567247/214451251-b778b880-0d4b-4707-b26a-018baa8e11db.png">
Figure 2: User table
 
Attributes for Users table
 
user_id {PK}
This column is an integer that can hold values up to 20 digits long. It is set as the primary key, which means it is a unique identifier for each row in the table. It is set to be auto-incrementing, which means that it will automatically be assigned a unique value for each new row that is added to the table. It also acts as a foreign key in other tables.

user_name
This column is a string that can hold up to 32 characters. It is marked as not null, which means that it is required to have a value for each row in the table.

password
This column is a string that can hold up to 255 characters. It is marked as not null, which means that it is required to have a value for each row in the table. It is also hashed and salted when stored in database.

first_name, family_name, email_address, address and account_role
These columns are all strings that can hold up to 255 characters. It is marked as not null, which means that it is required to have a value for each row in the table. They are used when a user is registering an account.

gender
This column is a boolean type, which can hold either a 1 (true) or a 0 (false) value. It is marked as not null, which means that it is required to have a value for each row in the table.

date_of_birth
This column is a date type, which can hold a date value in the format YYYY-MM-DD. It is marked as not null, which means that it is required to have a value for each row in the table.

phone_number
This column is an integer that can hold values up to 20 digits long. It is marked as not null, which means that it is required to have a value for each row in the table.














<img width="194" alt="image" src="https://user-images.githubusercontent.com/87567247/214451684-df413485-8a68-4d1b-a1ab-66e247184a53.png">
category_id {PK}
This column is an integer that can hold values up to 20 digits long. It is set as the primary key, which means it is a unique identifier for each row in the table, and it is set to be auto-incrementing,
which means that it will automatically be assigned a unique value for each new row that is added to the table. It also acts as a foreign key in other tables.

category_type 
This column is a string that can hold up to 20 characters. It is marked as not null, which means that it is required to have a value for each row in the table.

<img width="178" alt="image" src="https://user-images.githubusercontent.com/87567247/214451697-757c04b5-e569-47ad-8088-455e6c1d482f.png">
item_id {PK}
This column is an integer types that can hold values up to 20 digits long. It is set as the primary key, which means it is a unique identifier for each row in the table. It is set to be auto-incrementing, which means that it will automatically be assigned a unique value for each new row that is added to the table. It also acts as a foreign key in other tables.

item_name, item_description and state
These two columns are string types that can hold up to 255, 1000 and 20 characters. It is marked as not null, which means that it is required to have a value for each row in the table.

starting_price, reserve_price and bid_count
These columns are integer types that can hold values up to 20 digits long. It is marked as not null, which means that it is required to have a value for each row in the table.

item_category {FK} and seller_id {FK}
These two columns are integer types that can hold values up to 20 digits long. It is marked as not null, which means that it is required to have a value for each row in the table. They are both foreign keys, item_category refers to the categrory_id column of the categories table and seller_id refers to the user_id column of the users table. These values must match each other otherwise errors will occur. The foreign keys are referenced different names compared to their original primary key name because it allows anyone accessing the database to read and follow the queries easier. It also reduces chance of making a mistake with MYSQL and causing error.

end_date
This column is a datetime type, which can hold a date and time value in the format YYYY-MM-DD HH:MM:SS. It is marked as not null, which means that it is required to have a value for each row in the table.



<img width="141" alt="image" src="https://user-images.githubusercontent.com/87567247/214451997-9fb5480c-fbc1-4258-a4be-5d7e8772c0d6.png">

bid_id {PK} 
This column is an integer that can hold values up to 20 digits long. It is set as the primary key, which means it is a unique identifier for each row in the table. It is set to be auto-incrementing, which means that it will automatically be assigned a unique value for each new row that is added to the table.

bidder_id {FK}, item_id {FK} and bid_price
These columns are integer types that can hold values up to 20 digits long. It is marked as not null, which means that it is required to have a value for each row in the table. They are both foreign keys, bidder_id refers to the user_id column of the users table and item_id refers to the item_id column of the items table. These values must match each other otherwise errors will occur.

 
createdDate
This column is a timestamp type, which stores a date and time value in the format YYYY-MM-DD HH:MM:SS. It is marked as not null, and it has a default value of the current timestamp, which means that it will automatically be set to the current date and time when a new row is added to the table.





<img width="142" alt="image" src="https://user-images.githubusercontent.com/87567247/214452225-46c8f8d6-f5a9-450a-b558-a27d369bda40.png">
Order_id {PK}
This column is an integer that can hold values up to 20 digits long. It is set as the primary key, which means it is a unique identifier for each row in the table. It is set to be auto-incrementing, which means that it will automatically be assigned a unique value for each new row that is added to the table. 

winner_id {FK} and item_id {FK} 
These two columns are integer types that can hold values up to 20 digits long. It is marked as not null, which means that it is required to have a value for each row in the table. They are both foreign keys, winner_id refers to the user_id column of the users table and item_id refers to the item_id column of the items table.

final_bid_price
This column is an integer that can hold values up to 20 digits long. It is marked as not null, which means that it is required to have a value for each row in the table.

<img width="145" alt="image" src="https://user-images.githubusercontent.com/87567247/214452297-be013fb9-0c2e-4311-89c7-5054c675a8bf.png">
user_id {FK} and item_id {FK}
These two columns are integer types that can hold values up to 20 digits long. It is marked as not null, which means that it is required to have a value for each row in the table. They are both foreign keys, user_id refers to the user_id column of the users table and item_id refers to the item_id column of the items table. This table was created to showcase the relationship between user table and item table as it had a complex relationship.
 



Relationships Between Tables
There are many relationships between the tables such as:
•	User table (Seller) has a one-to-many relationship with items table. A user can act as seller to register any number of items(listings).
•	Users, Bids and Items have a tertiary higher order relationship in which a user acting as buyer can place many bids on many items.
•	Users, Orders and Items also have a tertiary higher order relationship in which a user acting as buyer can win one order from each item.
•	Many-to-many relationships are often implemented in a database by creating a separate table, known as a "junction" or "link" table, to store the relationships between the two entities. The Watchlist table was created to show the many to many relationship between the User and Item tables. A user can have one watch list and many items can be added to one watchlist
•	Items table has a many to one to relationship with Categories table. Each category has 0 or more items within it.




Database Schema in Third Normal Form
In database design, the third normal form (3NF) is a normal form that is used to ensure that a database is free of certain types of data redundancy and inconsistencies. It is a refinement of the second normal form (2NF) and is typically used in the design of relational databases.
Our Database Schema is in 3NF because it satisfies the following three conditions:
•	The database is in second normal form (2NF). This means that all non-key attributes in the database are fully dependent on the primary key, and there are no partial dependencies. For example in the user table item_name, item_description, starting_price, reserve_price end_date, bid_count, and state attributes are dependent on item_id.
•	There are no transitive dependencies in the database. Transitive dependencies can lead to data redundancy and inconsistencies, so they must be eliminated in order to achieve 3NF.
•	All non-key attributes in the database are directly dependent on the primary key. This means that there are no non-key attributes that are dependent on other non-key attributes, and all non-key attributes are directly dependent on the primary key.
 

Database Queries


# 1 Users can register with the system and create accounts.
The function of this step is to find whether 'username' already exists in the database. The purpose of this step is to verify that our system cannot have the same username. When you register with the username, you will be prompted that the username has been registered
The following codes are used to store various information provided by users during registration, including hashed passwords (shown below), email addresses, genders, phone numbers, etc. into the database.
When users register, they may fill in the wrong information and cause the system to report an error. To make it more beautiful, we use the alert () function in JavaScript to program. For example, when the username already exists, a window will pop up saying, 'The username already exists'

 
#2 Users can login with the system.
The first step in the login process is to check whether the username and password are filled in. If not, use the alert() function to report an error. As above, the significance of using the alert() function is still to make the page more realistic and professional.
The second step in the login process is to check whether the username and password match through the database. In this process, if they do not match, the alert () function is also used to alert
A SELECT statement is used to retrieve rows from the users table. The user_id, user_name, and password columns are specified in the SELECT clause, and the WHERE clause specifies that only rows with a user_name value matching the $username variable should be returned.
The result of the query_database function is stored in the $result variable.
Fetching the row from the result: The mysqli_fetch_assoc function is called to retrieve the first row from the
$result variable. This function returns an associative array that represents the row, with the column names as the keys and the column values as the values. The result is stored in the $row variable. Checking if the row exists: If the $row variable is not null, it means that a matching row was found in the users table and can successfully login.
The password column value is retrieved from the $row array and stored in the $hashed_password variable. The password_verify function is used to compare the $password variable (which contains the user's entered password) to the $hashed_password variable (which contains the hashed password from the database). If the two passwords match, it means that the user's entered password is correct.
Starting a new session: If the password is correct, a new session is started for the authenticated user and they are logged in.
 


#3 Users have roles of seller or buyer with different privileges.
#3.1 One privilege of a seller account is the my auctions privilege, which shows all items listed by seller.
This is a function called display_seller_auctions that takes a user ID as an argument and displays the auctions of a certain seller. It performs the following tasks:

The query starts with the SELECT clause, which specifies the columns that should be included in the results.

The FROM clause specifies the tables that the query should retrieve data from. In this case, the query is accessing four tables: items, categories, users, and bids. Each table is given an alias (e.g., a for items, b for categories) to make it easier to reference the columns in the SELECT clause.

The WHERE clause specifies the conditions that must be met for a row to be included in the results. In this case, the query is joining the items table with the categories table using the item_category column from items and the category_id column from categories. It is also joining the items table with the users table using the seller_id column from items and the user_id column from users. Additionally, it is joining the items table with the bids table using the item_id column from both tables.


The AND clause at the end of the WHERE clause specifies that only auctions with a certain seller_id should be included in the results. The seller_id is passed in as a parameter to the function and is enclosed in curly braces and single quotes to prevent SQL injection attacks.
 

The GROUP BY clause groups the results by item_id, and the MAX function is used to find the maximum bid_price for each group.


Finally, the mysqli_query function is used to execute the query and store the results in the $result variable. This $result variable can then be used to loop through the results and retrieve the specific data that was selected by the query.

 $result = mysqli_query($connection, $sql_bids);	


#3.2 One privilege of a buyer account is the my bids privilege, which shows all items bid on by the buyer.
This function retrieves information about bids made by a certain buyer, identified by the user_id parameter. The function executes a SQL query to retrieve information about bids from several tables in the database.
Function display_buyer_bids($user_id)	
The SELECT clause specifies the columns that should be included in the results, including the item_id, bid_count, item_name, category_type, item_description, user_name, and bid_price.


The FROM clause specifies the tables that the query should retrieve data from, and the WHERE clause specifies the conditions that must be met for a row to be included in the results.

The AND clause at the end of the WHERE clause specifies that only bids made by a certain bidder_id should be included in the results.
Following the execution of the query, the function iterates through the results, storing the obtained data in variables. Including the item_name, item_id, bid_count, seller_name, bid_price, and category. These variables could then be used for further processing or to display the information to the user.



#3.3 One privilege of a buyer account is the my orders privilege, which shows all orders a buyer has made.
This function retrieves information about orders made by a certain buyer, identified by the user_id parameter.The function executes a SQL query to retrieve information about orders from several tables in the database.

 

The SELECT clause specifies the columns that should be included in the results, including the item_id, item_name, end_date, bid_count, user_name, category_type, and final_bid_price. . The FROM clause specifies the tables that the query should retrieve data from.


The WHERE clause specifies the conditions that must be met in order for a row to be included in the results. The AND clause at the end of the WHERE clause specifies that only orders placed by a certain winner_id should be included in the results.

After executing the query, the function loops through the results and stores the retrieved information in variables, including the item_id, item_name, seller_name, bid_count, final_bid_price, and category.



#4 Get profile for a certain user or admin
This function retrieves the profile information for a certain user or admin, depending on the user's role. The role of the user is determined by the account_type value stored in the $_SESSION array, which is a special array that stores data about the current session.
The function begins by establishing a connection to the database using the get_connection function.


If the user's role is "admin", the function retrieves the admin_id from the $_SESSION array and constructs an SQL SELECT statement to retrieve the profile information for the admin from the users table using the admin_id as a filter.


If the user's role is not "admin", the function retrieves the user_id from the $_SESSION array and constructs an SQL SELECT statement to retrieve the profile information for the user from the users table using the user_id as a filter.
 

 
The function then executes the SELECT statement using mysqli_query and stores the result in the $result variable. It then retrieves the first row from the $result variable using mysqli_fetch_assoc and stores it in the
$row variable.
Finally, the function returns the $row variable, which contains the profile information for the user or admin.





#5 Edit user profile
This function is used to edit the profile information for a certain user. It is called with the user_name of the user whose profile is being edited as a parameter. The function begins by establishing a connection to the database using the get_connection function. It then checks if the submit element of the $_POST array is set, indicating that the user has submitted the form to edit their profile.


If the form has been submitted, the function retrieves the form data from the $_POST array and stores it in variables. It then constructs an SQL UPDATE statement to update the user's profile information in the users table using the user_name of the user as a filter. The UPDATE statement sets the user_name, first_name, family_name, gender, date_of_birth, email_address, phone_number, and address columns to the values retrieved from the $_POST array.
The function then executes the UPDATE statement using the query_database function
 

 


#6 Search Homepage for items
This function can be used to search for items based on a keyword, category, and ordering criteria.


Gets details of expired auctions if ordering = pricelow/pricehigh. This code block checks whether the value of the $ordering variable is either 'pricelow' or 'pricehigh'. If either of these conditions is true, then it creates a string called $sql_user_watch that represents a SELECT statement in SQL.
The SELECT statement retrieves several columns from multiple tables in the database: items, categories, users, and bids. The tables are joined together using the WHERE clause, and the resulting rows are filtered to only include items that have a state of 'active'. The SELECT statement also includes a column called max_price, which is the maximum value of the bid_price column in the bids table. This column is generated using the MAX() function.
 

 


The next block of code appends an additional condition to the SELECT statement, which filters the results based on the value of the $keyword parameter. The condition uses the LIKE operator to search for items whose item_name or item_description fields contain the keyword.


This query filters the results to only include active items, and it also retrieves the maximum bid price for each item as max_price.
If the value of the $ordering variable is pricelow or pricehigh, this code will be executed. It first adds a GROUP BY clause to the $sql_user_watch query, grouping the results by the item_id column. This means that the query will return a single row for each unique value of item_id.
Next, it uses a switch statement to add an ORDER BY clause to the $sql_user_watch query, based on the value of $ordering. If $ordering is pricelow, the query will be sorted by max_price in ascending order. If
$ordering is pricehigh, the query will be sorted by max_price in descending order. This means that the query results will be sorted by the maximum bid price of each item, either from lowest to highest or from highest to lowest, depending on the value of $ordering


The next query allows users to join searches for keywords withen categories and sort them based on expiry date and these items are ordered either ascendingly or decsendingly.
 

 
The function checks if the value of $ordering is either 'pricelow' or 'pricehigh'. If it is, the function sets up a SQL query that selects the item ID, item name, end date, category type, user name, and maximum bid price for all items in the 'active' state that meet the search criteria specified by the other parameters. The query also joins the items, categories, and users tables and groups the results by item ID. Finally, it orders the results by maximum bid price in ascending or descending order, depending on the value of $ordering.
If the value of $ordering is not 'pricelow' or 'pricehigh', the function sets up a SQL query that selects the item ID, item name, end date, category type, and user name for all items in the 'active' state that meet the search criteria specified by the other parameters. The query also joins the items, categories, and users tables.
Finally, it orders the results by item name, end date in ascending or descending order, depending on the value of $ordering. The function then returns the result set of the SQL query.

 

#7 Item display
This query is constructed to retrieve data about a particular item with the provided item_id. This query is executed and the result is stored in the $result variable.


#8 - Sellers can create auctions for particular items, setting suitable conditions and features of the items including the item description, categorisation, starting price, reserve price and end date.
Retrieving the seller's user ID: The $_SESSION['user_id'] variable is used to retrieve the seller's user ID from the current session. The seller's user ID is stored in the $seller variable.


Preparing an INSERT statement: The $sql_insert_new_auction variable stores an INSERT INTO statement that is used to insert a new row into the items table. The VALUES clause specifies placeholders for the values to be inserted into each column of the table.


The $default_bidcount variable is set to 0, which will be used as the default value for the bid_count column of the items table. The "active" string will be used as the default value for the state column of the items table.


The prepare_bind_execute function is called to execute the INSERT statement and insert the new item into the items table. The $sql_insert_new_auction variable is passed as the first argument to specify the SQL query to execute, and the "ssiisssss" string is passed as the second argument to specify the types of the parameters in the query.


The remaining arguments are the values to be inserted into each column of the table: $_POST['name'],
$_POST['description'], $_POST['startingprice'], $_POST['reserveprice'], $_POST['category'],
 

$_POST['endtime'], $default_bidcount, $seller, and "active". The $insert_item_result variable is used to store the result of the prepare_bind_execute function, which will indicate whether the query was successful or not.


#9 - Buyers can bid for items and see the bids other users make as they are received.
This function take_bid is used to place a bid on a certain auction item, identified by the item_id parameter.
The function begins by establishing a connection to the database using the $connection parameter. It then starts a database transaction, which allows multiple SQL statements to be executed as a single unit of work. This is useful because it ensures that either all of the statements are executed successfully, or none of them are executed at all. This helps to maintain the integrity of the data in the database.


The function then defines a variable $currentUser and assigns it the value of the user_id key in the
$_SESSION superglobal array. Next, the function runs a mysqli_query function that begins a MySQL transaction.


Then, the function defines a variable $sql1 and assigns it a string containing an SQL INSERT statement with placeholders for user input. The function then calls the prepare_bind_execute function and passes it $sql1 and three other parameters: a string of 'isi', which specifies the types of the three placeholders, and the variables $currentUser, $item_id, and $bid_price. This function prepares an SQL statement using the mysqli_prepare function, binds the parameters to the placeholders using mysqli_stmt_bind_param, and then executes the statement using mysqli_stmt_execute. The function assigns the result of this function call to a variable $res1.
 

The function then defines a second variable $sql2 and assigns it a string containing an SQL UPDATE statement with a placeholder for user input. The function then calls the prepare_bind_execute function again, passing it $sql2 and two other parameters: a string of 'i', which specifies the type of the placeholder, and the variable $item_id. This function prepares an SQL statement using the mysqli_prepare function, binds the parameter to the placeholder using mysqli_stmt_bind_param, and then executes the statement using mysqli_stmt_execute. The function assigns the result of this function call to a variable $res2.

If both of these statements are successfully executed, the function commits the transaction, making the changes to the database permanent. The function rolls back the transaction, undoing all modifications that were done, if either of the statements fails.

Finally, the function returns a $flag variable, which is set to true if the transaction was successful and false otherwise. This $flag variable could be utilised to let the user know whether the bid was successfully placed or to display an error message to the user.



#10 The system will manage the auction until the set end time and award the item to the highest bidder. The system should confirm to both the winner and seller of an auction its outcome.
Retrieving a list of expired auctions by querying the items table and selecting all auctions whose end date is earlier than the current date and have a state of "active".

Looping through each of the expired auctions and finding the highest bid for each auction. This is done by first selecting the maximum bid price for the auction using the bids table, and then selecting all bids that have the maximum bid price and belong to the auction.
 


 
Inserting a new row into the orders table for the auction with the winning bid, using the bidder's ID and the item's ID as well as the maximum bid price.


 
The next SQL query retrieves user_id for a particular item.
The mysqli_query() function is used to execute the SQL query and return the result set. The mysqli_fetch_assoc() function is then used to retrieve a single row from the result set as an associative array, with the keys corresponding to the column names in the result set. The resulting row is stored in the variable
$find_seller.

$sql_seller_find = "SELECT a.user_id as user from users a, items b where a.user_id



Retrieving the seller's email address for the auction and sending them an email using the emails_main function.

 

Retrieving the winning bidder's email address and sending them an email using the emails_main function. Updating the state of the auction in the items table to "inactive".


#11 - Buyers can watch auctions on items and receive emailed updates on bids on those items including notifications when they are outbid.
The functionname parameter in the $_POST array is used to determine whether the user is adding an item to the watchlist or removing it.

If the functionname is "add_to_watchlist", the code prepares and executes an SQL INSERT statement using the prepare_bind_excecute function.
The INSERT statement adds a new row to the watchlist table, with the user_id and item_id specified by the
$user_id and $item_id variables, respectively. If the INSERT statement is executed successfully, the code sets the $res variable to "success". If an exception is thrown, the $res variable is set to "duplicate data".

If the functionname is "remove_from_watchlist", the code prepares and executes an SQL DELETE statement using the prepare_bind_excecute function. The DELETE statement removes the row from the watchlist table with the item_id specified by the $item_id variable. If the DELETE statement is executed successfully, the code sets the $res variable to "success".
 

#12 - This function retrieves a list of recommended auction items for a user.
The recommended items are based on the categories of items that the user has previously bid on.

The SELECT statement retrieves information about items from the items table, and also retrieves the corresponding category information from the categories table and the seller information from the users table.
The WHERE clause of the SELECT statement uses a subquery to filter the results to only include items that are in the same category as items that the user has previously bid on.
The subquery first retrieves the item_id of items that the user has bid on, and then retrieves the corresponding item_category for those items.


The subquery then groups the item_category values and counts the number of occurrences for each category, and orders the results by the count in descending order. The outer query then uses the resulting list of categories to filter the results to only include items that are in those categories.
The SELECT statement also includes an ORDER BY clause to sort the results by the item_name column, and a LIMIT clause to return only the first 4 rows.
Finally, the function returns the result of the SELECT statement as an array of rows.
 

 


#13 Precise Recommendations For Buyers based on bids
As a buyer, the system will search for this user’s bid history and get the ItemID of all his bids.
SELECT item_id from bids where bidder_id = '{$user_id}'	
Then, the system will search in bids of all the people who bid the same item with you. And it will record their UserIDs.
Lastly, the system will search for the auctions by their UserIDs in bids table and show show them in items table.
 

#13 Recommendations For users not logged in
This function returns a result set of active items that are recommended for a visitor based on the most successful sellers and items in the past.
The SELECT statement retrieves the item_id, item_name, end_date, category_type, and user_name from the items, categories, and users tables where the item's state is 'active' and the seller_id matches the seller_id of items that have been ordered in the past.
The seller_id of those items is determined by finding the sellers who have had the most items ordered in the past, then finding the items that have had the most bids placed on them, and selecting the seller_id of those items.
The SELECT statement also joins the items table with the categories and users tables on the item_category and seller_id columns, respectively.
The result set is limited to the first 4 items.
