###################
How to install this project 
###################

1. Clone this project in your folder (windows)
(if using wamp) www/wamp64/ or clone in htdocs (if using xampp)

if you using linux :
before installing this project, you have to install (php,mysql,apache)
https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-16-04


3. in your local environtment CREATE DATABASE nusatek;
4. in your local environtment run this query in phpmyadmin

CREATE TABLE `user` (
 `id` int NOT NULL AUTO_INCREMENT,
 `Firstname` varchar(50) NOT NULL,
 `Surname` varchar(50) NOT NULL,
 `Username` varchar(50) NOT NULL,
 `Password` varchar(50) NOT NULL,
 `Email` varchar(50) NOT NULL,
 `Nik` int NOT NULL,
 `photo` varchar(50) NOT NULL,
 `Roles` enum('APL','ACS','ADM') NOT NULL,
 `Status` int DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci

4. run this project in postman 

example :

http://localhost/nusatek/index.php/api/get



