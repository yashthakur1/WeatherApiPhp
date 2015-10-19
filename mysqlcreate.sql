CREATE Database weather; /* This Creates Database*/
Use weather; /* This specifies that further queries will run in this Database itself*/

/* Below line Creates table with 5 columns*/
CREATE TABLE `weather`.`data1` ( `Serial#` INT(200) NOT NULL AUTO_INCREMENT , `Location` VARCHAR(100) NOT NULL , `Temperature` VARCHAR(100) NOT NULL , `Humidity` VARCHAR(100) NOT NULL , `Time` VARCHAR(100) NOT NULL , PRIMARY KEY (`Serial#`)) ENGINE = InnoDB;


/*Paste this whole above code in phpmyadmin->sql tab goto "localhost/phpmyadmin" in your browser and click on sql tab on the right panel and paste the whole code and click on go.
This will execute your query and create database and table aswell. now the PHP file has the details of the database pre-written on it , re-check it and you are good to go.
*/
