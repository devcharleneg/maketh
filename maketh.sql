DROP DATABASE maketh;
CREATE DATABASE maketh;
USE maketh;

CREATE TABLE IF NOT EXISTS `user`
(
	`username` VARCHAR(15) NOT NULL UNIQUE,
	`password` VARCHAR(20) NOT NULL,
	`fname` VARCHAR(50) NOT NULL,
	`lname` VARCHAR(50) NOT NULL,
	`mname` VARCHAR(50) NOT NULL,
	`address` VARCHAR(500) NOT NULL,
	`bday` DATE NOT NULL,
	`email` VARCHAR(50) NOT NULL UNIQUE,
	`contact_no` VARCHAR(20) NOT NULL,
	`gender` VARCHAR(6) NOT NULL,
	`access_type` VARCHAR(8) NOT NULL,
	PRIMARY KEY(`username`)    
);

CREATE TABLE IF NOT EXISTS `product`
(
	`item_thumbnail` VARCHAR(1000),
	`item_code` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`item_name` VARCHAR(50) NOT NULL,
	`brand` VARCHAR(50),
	`description` VARCHAR(1000),
	`sex` VARCHAR(10),
	`category` VARCHAR(30) NOT NULL,
	`sub_category` VARCHAR(30) NOT NULL,
	`color` VARCHAR(30),
	`size` VARCHAR(20),
	`material` VARCHAR(40),
	`qty` INT NOT NULL,
	`unit_price` DECIMAL(8,2) NOT NULL,
	`sale_percent` INT NOT NULL,
	`old_price` DECIMAL(8,2) DEFAULT 0,
	PRIMARY KEY(`item_code`)
);

CREATE TABLE IF NOT EXISTS `product_image`
(
	`product_image_no` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`item_code` INT(6) UNSIGNED ZEROFILL NOT NULL,
	`product_image` VARCHAR(500),
	PRIMARY KEY(`product_image_no`),
	FOREIGN KEY(`item_code`) 
		REFERENCES `product`(`item_code`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `orders`
(	
	`order_no` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`delivery_address` VARCHAR(1000) NOT NULL,
	`mode_of_payment` VARCHAR(50) NOT NULL,
	`credit_card_no` VARCHAR(25),
	`contact_no` VARCHAR(20),
	`pin_no` INT(4),
	`total` DECIMAL(8,2) NOT NULL,
	`username` VARCHAR(15)  NOT NULL,
	`date_ordered` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	PRIMARY KEY(`order_no`),
	FOREIGN KEY(`username`) 
		REFERENCES `user`(`username`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `ordered_product`
(	
	`order_product_no` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`order_no` INT(6) UNSIGNED ZEROFILL NOT NULL,
	`item_code` INT(6) UNSIGNED ZEROFILL NOT NULL,
	`ordered_qty` INT NOT NULL,
	`total_price` DECIMAL(8,2) NOT NULL,
	PRIMARY KEY(`order_product_no`),
	FOREIGN KEY(`order_no`) 
		REFERENCES `orders`(`order_no`)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY(`item_code`) 
		REFERENCES `product`(`item_code`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `homepage_image`
(
	`homepage_image_no` INT NOT NULL AUTO_INCREMENT,
	`homepage_image` VARCHAR(500) NOT NULL,
	PRIMARY KEY(`homepage_image_no`)
);

CREATE TABLE IF NOT EXISTS `cart`
(
	`cart_no` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(15) NOT NULL,
	`item_code` INT(6) UNSIGNED ZEROFILL NOT NULL,
	`qty_in_cart` INT DEFAULT 0,
	`total_price` DECIMAL(8,2) NOT NULL,
	PRIMARY KEY(`cart_no`),
	FOREIGN KEY(`username`) 
		REFERENCES `user`(`username`)
			ON DELETE CASCADE
			ON UPDATE CASCADE,
	FOREIGN KEY(`item_code`) 
		REFERENCES `product`(`item_code`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

INSERT INTO `user` VALUES('admin','password','Cha','Gonzales','T','Bataan','1993-11-05','charlene.gonzles@gmail.com','0977771789','Female','admin')
