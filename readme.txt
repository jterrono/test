All Requirements have been met.
dd
Authentication

A user will gain access to the api by using their email & their API-KEY. It is plain text, nothing
complicated. If no credentials are passed or incorrect. Access will be denied.

Database SQL


CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `image_url` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Will hold produt details';



INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `status`) VALUES
	(1, 'T-Shirt', 'This is a t-shirt', 20.00, '/uploads/1.jpg', 1),
	(2, 'T-Shirt', 'This is a t-shirt', 20.00, '', 1),
	(3, 'Pants Small', 'This is pants', 119.99, '', 1),
	(4, 'test', 'test123', 5.99, '', 1),
	(5, 'test', 'This is my UPDATE sweatshirt', 19.99, '', 1),
	(6, 'Sweatshirt', 'This is my sweatshirt', 19.99, '', 0);


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `api_key` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Will hold user info';


INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `api_key`) VALUES
	(1, 'James', 'Terrono', 'jterrono@gmail.com', '123456'),
	(2, 'Bob', 'Doe', 'jterrono123@gmail.com', 'seconduser'),
	(3, 'Jane', 'Doe', 'jandoe@hotmail.com', 'jandoe123'),
	(4, 'Joe', 'T', 'joet@gmail.com', 'joet123'),
	(5, 'Michelle', 'B', 'michelleb@gmail.com', 'michelle123');




CREATE TABLE IF NOT EXISTS `user_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Joins products to users';



INSERT INTO `user_products` (`id`, `user_id`, `product_id`, `status`) VALUES
	(4, 2, 5, 1),
	(3, 1, 5, 1),
	(5, 5, 5, 1);

