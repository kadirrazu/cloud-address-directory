<?php

require_once('database-connection.php');

mysqli_query($connection, "CREATE TABLE IF NOT EXISTS `kr_users` (
 `id` int(6) NOT NULL AUTO_INCREMENT,
 `email` varchar(60) NOT NULL,
 `password` varchar(60) NOT NULL,
 `name` varchar(60) DEFAULT NULL,
 `user_type` int(6) NOT NULL DEFAULT '1',
 `ts_create` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
)");

mysqli_query($connection, "INSERT INTO kr_users (email, password, name)
SELECT * FROM (SELECT 'user@kadirrazu.info', MD5('123456'), 'Md. Abdul Kadir') AS tmp
WHERE NOT EXISTS (
    SELECT email, password FROM kr_users WHERE email = 'user@kadirrazu.info' AND password = MD5('123456')
) LIMIT 1");

$sqlCreateTableKrCircle = "CREATE TABLE IF NOT EXISTS `kr_circle` (
 `id` int(6) NOT NULL AUTO_INCREMENT,
 `circle_title` varchar(60) NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
)";

mysqli_query($connection, $sqlCreateTableKrCircle);

$sqlInsertIntoKrCircle = "INSERT INTO `kr_circle` (`id`, `circle_title`, `created_at`) VALUES (NULL, 'No Circle', CURRENT_TIMESTAMP)";

mysqli_query($connection, $sqlInsertIntoKrCircle);

$sqlCreateTableKrContacts = "CREATE TABLE IF NOT EXISTS `kr_contacts` (
 `id` int(6) NOT NULL AUTO_INCREMENT,
 `first_name` varchar(60) NOT NULL,
 `last_name` varchar(60) NOT NULL,
 `email` varchar(60) DEFAULT NULL,
 `circle_id` int(6) NOT NULL DEFAULT '1',
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`)
)";

mysqli_query($connection, $sqlCreateTableKrContacts);

$sqlCreateTableKrContactMeta = "CREATE TABLE IF NOT EXISTS `kr_contact_meta` (
 `id` int(6) NOT NULL AUTO_INCREMENT,
 `contact_id` int(6) NOT NULL,
 `key` varchar(60) NOT NULL,
 `value` varchar(255) DEFAULT NULL,
 PRIMARY KEY (`id`)
)";

mysqli_query($connection, $sqlCreateTableKrContactMeta);

echo "Cheers Buddy! Database was prepared for your use.";

