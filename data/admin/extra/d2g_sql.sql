-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2017 at 08:42 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/* HOTEL */
CREATE TABLE `hotels` (
	`hotel_ID` int(10) NOT NULL,
	`hotel_image` varchar(100) DEFAULT NULL,
	`hotel_name` varchar(100) DEFAULT NULL,
	`hotel_phone` int(15) DEFAULT NULL,
	`hotel_currency` varchar(50) DEFAULT NULL,
	`hotel_max_room` int(25) DEFAULT NULL,
	`hotel_address` varchar(300) DEFAULT NULL,
	`hotel_street` varchar(300) DEFAULT NULL,
	`hotel_city` varchar(100) DEFAULT NULL,
	`hotel_state` varchar(100) DEFAULT NULL,
	`hotel_country` varchar(100) DEFAULT NULL,
	`hotel_postal` int(10) DEFAULT NULL,
	`background_image` varchar(100) DEFAULT NULL,
	`weather_ID` varchar(20) DEFAULT NULL,
	`weather_key` varchar(100) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `hotels` ADD PRIMARY KEY (`hotel_ID`);

ALTER TABLE `hotels` MODIFY `hotel_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* DEVICE TABLE */
CREATE TABLE `device` (
	`tabs_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`room_no` int(10) DEFAULT NULL,
	`mac_address` int(25) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `device` ADD PRIMARY KEY (`tabs_ID`);

ALTER TABLE `device` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `device` MODIFY `tabs_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* USERS TABLE */
CREATE TABLE `users` (
  `user_ID` int(10) NOT NULL,
  `hotel_ID` int(10) NOT NULL,
  `user_type` int(10) DEFAULT NULL,
  `firstname` varchar(60) DEFAULT NULL,
  `middlename` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users` ADD PRIMARY KEY (`user_ID`);

ALTER TABLE `users` MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* GUESTS TABLE */
CREATE TABLE `guests` (
  `guest_ID` int(10) NOT NULL,
  `hotel_ID` int(10) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `account_status` int(10) NOT NULL,
  `firstname` varchar(60) DEFAULT NULL,
  `middlename` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `room_no` int(10) NOT NULL,
  `inclusion` varchar(100) DEFAULT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal` int(10) NOT NULL,
  `deleted` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `guests` ADD PRIMARY KEY (`guest_ID`);

ALTER TABLE `guests` MODIFY `guest_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* GUESTSHISTORY TABLE */
CREATE TABLE `guestshistory` (
  `guest_ID` int(10) NOT NULL,
  `hotel_ID` int(10) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `account_status` int(10) NOT NULL,
  `firstname` varchar(60) DEFAULT NULL,
  `middlename` varchar(60) DEFAULT NULL,
  `lastname` varchar(60) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `room_no` int(10) NOT NULL,
  `inclusion` varchar(100) DEFAULT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Indexes for table `users`
--
ALTER TABLE `guestshistory` ADD PRIMARY KEY (`guest_ID`);

ALTER TABLE `guestshistory` MODIFY `guest_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
/* SERVICES TABLE */
CREATE TABLE `services` (
	`service_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`serviceName` varchar(100) DEFAULT NULL,
	`image` varchar(50) DEFAULT NULL,
	`time_open` datetime DEFAULT NULL,
	`time_close` datetime DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `services` ADD PRIMARY KEY (`service_ID`);

ALTER TABLE `services` MODIFY `service_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
/* SERVICES_PRODUCT TABLE */
CREATE TABLE `services_product` (
	`serviceProd_ID` int(10) NOT NULL,
	`service_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`serviceProdName` varchar(100) DEFAULT NULL,
	`serviceProdDesc` varchar(600) DEFAULT NULL,
	`serviceProdPrice` decimal(16,2) DEFAULT NULL,
	`image` varchar(50) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `services_product` ADD PRIMARY KEY (`serviceProd_ID`);

ALTER TABLE `services_product` MODIFY `serviceProd_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
/* SERVICES_CART */
CREATE TABLE `services_cart` (
	`serviceOrderDetail_ID` int(10) NOT NULL,
	`serviceProd_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`serviceProdName` varchar(100) DEFAULT NULL,
	`serviceProdDesc` varchar(600) DEFAULT NULL,
	`serviceProdPrice` decimal(16,2) DEFAULT NULL,
	`serviceProdDuration` int(10) DEFAULT NULL,
	`subtotal` decimal(16,2) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `services_cart` ADD PRIMARY KEY (`serviceOrderDetail_ID`);
	
ALTER TABLE `services_cart` MODIFY `serviceOrderDetail_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

/* SERVICES_ORDERDETAIL */
CREATE TABLE `services_orders` (
	`serviceOrder_ID` int(10) NOT NULL,
	`serviceProd_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`serviceProdName` varchar(100) DEFAULT NULL,
	`serviceProdDesc` varchar(600) DEFAULT NULL,
	`serviceProdPrice` decimal(16,2) DEFAULT NULL,
	`serviceProdDuration` int(10) DEFAULT NULL,
	`subtotal` decimal(16,2) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `services_orders` ADD PRIMARY KEY (`serviceOrder_ID`);
	
ALTER TABLE `services_orders` MODIFY `serviceOrder_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

/* SERVICES_ORDER */
CREATE TABLE `services_order_total` (
	`serviceTotal_ID` int(10) NOT NULL,
	`serviceOrder_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`grand_total` decimal(16,2) DEFAULT NULL,
	`notif` varchar(50) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `services_order_total` ADD PRIMARY KEY (`serviceTotal_ID`);
	
ALTER TABLE `services_order_total` MODIFY `serviceTotal_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
	
	
/* RESTAURANTS */
CREATE TABLE `restaurants` (
	`restaurant_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`restaurant_name` varchar(100) DEFAULT NULL,
	`time_open` datetime DEFAULT NULL,
	`time_close` datetime DEFAULT NULL,
	`description` varchar(600) DEFAULT NULL,
	`image` varchar(250) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `restaurants` ADD PRIMARY KEY (`restaurant_ID`);
	
ALTER TABLE `restaurants` MODIFY `restaurant_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
	
	
/* DISHSTYLES */
CREATE TABLE `dishstyles` (
	`dishstyle_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`restaurant_ID` int(10) NOT NULL,
	`dishstyle_name` varchar(100) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `dishstyles` ADD PRIMARY KEY (`dishstyle_ID`);
	
ALTER TABLE `dishstyles` MODIFY `dishstyle_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* CATEGORY */
CREATE TABLE `categories` (
	`category_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`restaurant_ID` int(10) NOT NULL,
	`category_name` varchar(100) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `categories` ADD PRIMARY KEY (`category_ID`);

ALTER TABLE `categories` MODIFY `category_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* RESTAURANT_MENUS */
CREATE TABLE `restaurant_menus` (
	`restomenu_ID` int(10) NOT NULL,
	`dishstyle_ID` int(10) NOT NULL,
	`category_ID` int(10) NOT NULL,
	`restaurant_ID` int(10) NOT NULL,
	`menu_name` varchar(600) DEFAULT NULL,
	`menu_price` decimal(16,2) DEFAULT NULL,
	`menu_basicPrice` decimal(16,2) DEFAULT NULL,
	`menu_desc` varchar(600) DEFAULT NULL,
	`menu_shortDesc` varchar(100) DEFAULT NULL,
	`pos_ref_ID` int(10) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `restaurant_menus` ADD PRIMARY KEY (`restomenu_ID`);

ALTER TABLE `restaurant_menus` MODIFY `restomenu_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* RESTAURANT_CART */
CREATE TABLE `restaurant_cart` (
	`restocart_ID` int(10) NOT NULL,
	`restomenu_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`menu_name` int(10) DEFAULT NULL,
	`menu_shortDesc` varchar(100) DEFAULT NULL,
	`menu_price` decimal(16,2) DEFAULT NULL,
	`quantity` int(10) DEFAULT NULL,
	`subtotal` decimal(16,2) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `restaurant_cart` ADD PRIMARY KEY (`restocart_ID`);

ALTER TABLE `restaurant_cart` MODIFY `restocart_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* RESTAURANT_ORDER */
CREATE TABLE `restaurant_order` (
	`restoorder_ID` int(10) NOT NULL,
	`restomenu_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`menu_name` int(10) DEFAULT NULL,
	`menu_shortDesc` varchar(100) DEFAULT NULL,
	`menu_price` decimal(16,2) DEFAULT NULL,
	`quantity` int(10) DEFAULT NULL,
	`subtotal` decimal(16,2) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `restaurant_order` ADD PRIMARY KEY (`restoorder_ID`);

ALTER TABLE `restaurant_order` MODIFY `restoorder_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* RESTAURANT_ORDER_TOTAL */
CREATE TABLE `restaurant_order_total` (
	`restototal_ID` int(10) NOT NULL,
	`restoorder_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`grand_total` decimal(16,2) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `restaurant_order_total` ADD PRIMARY KEY (`restototal_ID`);

ALTER TABLE `restaurant_order_total` MODIFY `restototal_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;





/* CHATS */
CREATE TABLE `chats` (
	`chats_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`by_admin_id` int(10) NOT NULL,
	`msg` varchar(500) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `chats` ADD PRIMARY KEY (`chats_ID`);

ALTER TABLE `chats` MODIFY `chats_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* NOTIFICATION_CHAT */
CREATE TABLE `notification_chat` (
	`notification_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`msg` varchar(500) DEFAULT NULL,
	`seen` varchar(500) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `notification_chat` ADD PRIMARY KEY (`notification_ID`);

ALTER TABLE `notification_chat` MODIFY `notification_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* FEEDBACKS */
CREATE TABLE `feedbacks` (
	`feedback_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`feedback_overall` int(10) DEFAULT NULL,
	`feedback_location` int(10) DEFAULT NULL,
	`feedback_room` int(10) DEFAULT NULL,
	`feedback_service` int(10) DEFAULT NULL,
	`feedback_value` int(10) DEFAULT NULL,
	`feedback_cleanliness` int(10) DEFAULT NULL,
	`feedback_restaurant` int(10) DEFAULT NULL,
	`feedback_message` int(10) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `feedbacks` ADD PRIMARY KEY (`feedback_ID`);

ALTER TABLE `feedbacks` MODIFY `feedback_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* HOUSEKEEPINGS */
CREATE TABLE `housekeepings` (
	`housekeeping_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`room_no` int(10) DEFAULT NULL,
	`hk_date` datetime DEFAULT NULL,
	`hk_status` int(10) DEFAULT NULL,
	`hk_notif` int(10) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `housekeepings` ADD PRIMARY KEY (`housekeeping_ID`);

ALTER TABLE `housekeepings` MODIFY `housekeeping_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* OFFERS */
CREATE TABLE `offers` (
	`offer_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`offer_name` varchar(60) DEFAULT NULL,
	`image` varchar(100) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `offers` ADD PRIMARY KEY (`offer_ID`);

ALTER TABLE `offers` MODIFY `offer_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* OFFERS_DETAIL */
CREATE TABLE `offers_detail` (
	`offerdetail_ID` int(10) NOT NULL,
	`offer_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`category` varchar(60) DEFAULT NULL,
	`offer_name` varchar(100) DEFAULT NULL,
	`offer_description` varchar(600) DEFAULT NULL,
	`offer_price` decimal(16,2) DEFAULT NULL,
	`original_price` decimal(16,2) DEFAULT NULL,
	`duration` int(10) DEFAULT NULL,
	`image` varchar(250) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `offers_detail` ADD PRIMARY KEY (`offerdetail_ID`);

ALTER TABLE `offers_detail` MODIFY `offerdetail_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* PLACES */
CREATE TABLE `places` (
	`adtype_ID` int(10) NOT NULL,
	`adtype_name` varchar(150) DEFAULT NULL,
	`image` varchar(150) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `places` ADD PRIMARY KEY (`adtype_ID`);

ALTER TABLE `places` MODIFY `adtype_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* PLACES_DETAIL */
CREATE TABLE `places_detail` (
	`ads_ID` int(10) NOT NULL,
	`adtype_ID` int(10) NOT NULL,
	`guest_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`ad_title` varchar(100) DEFAULT NULL,
	`ad_description` varchar(600) DEFAULT NULL,
	`ad_address` varchar(250) DEFAULT NULL,
	`ad_contact` int(20) DEFAULT NULL,
	`ad_time_start` datetime DEFAULT NULL,
	`ad_time_end` datetime DEFAULT NULL,
	`image_count` int(10) DEFAULT NULL,
	`image1` varchar(100) DEFAULT NULL,
	`image2` varchar(100) DEFAULT NULL,
	`image3` varchar(100) DEFAULT NULL,
	`image4` varchar(100) DEFAULT NULL,
	`image5` varchar(100) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `places_detail` ADD PRIMARY KEY (`ads_ID`);

ALTER TABLE `places_detail` MODIFY `ads_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* WEATHER */
CREATE TABLE `weather` (
	`weather_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`description` varchar(200) DEFAULT NULL,
	`icon` varchar(100) DEFAULT NULL,
	`temp` varchar(100) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `weather` ADD PRIMARY KEY (`weather_ID`);

ALTER TABLE `weather` MODIFY `weather_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* NOTIFICATION_ALL */
CREATE TABLE `notification_all` (
	`notification_all_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`notification_type` int(10) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `notification_all` ADD PRIMARY KEY (`notification_all_ID`);

ALTER TABLE `notification_all` MODIFY `notification_all_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* CHANNELS */
CREATE TABLE `channels` (
	`channel_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`channel_name` varchar(100) DEFAULT NULL,
	`channel_url` varchar(500) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `channels` ADD PRIMARY KEY (`channel_ID`);

ALTER TABLE `channels` MODIFY `channel_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* APPUPDATE */ 
CREATE TABLE `appupdate` (
	`appupdate_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`appname` varchar(100) DEFAULT NULL,
	`versionname` varchar(60) DEFAULT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `appupdate` ADD PRIMARY KEY (`appupdate_ID`);

ALTER TABLE `appupdate` MODIFY `appupdate_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


/* ACCESS */
CREATE TABLE `hotel_access` (
	`access_ID` int(10) NOT NULL,
	`hotel_ID` int(10) NOT NULL,
	`acces_name` varchar(100) DEFAULT NULL,
	`status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `hotel_access` ADD PRIMARY KEY (`access_ID`);

ALTER TABLE `hotel_access` MODIFY `access_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;



/* ADDING FOREIGN KEYS */
ALTER TABLE `device` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `users` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `guests` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `guestshistory` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `services` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `services_product` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels(`hotel_ID`);

ALTER TABLE `services_product` ADD FOREIGN KEY (`service_ID`) REFERENCES `services`(`service_ID`);

ALTER TABLE `services_cart` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `service_cart` ADD FOREIGN KEY (`serviceProd_ID`) REFERENCES `services_product`(`serviceProd_ID`);

ALTER TABLE `services_cart` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `services_orders` ADD FOREIGN KEY (`serviceProd_ID`) REFERENCES `services_product`(`serviceProd_ID`);

ALTER TABLE `services_orders` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `services_orders` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `services_order_total` ADD FOREIGN KEY (`serviceOrder_ID`) REFERENCES `services_order`(`serviceOrder_ID`);

ALTER TABLE `restaurants` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `dishstyles` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `dishstyles` ADD FOREIGN KEY (`restaurant_ID`) REFERENCES `restaurants`(`restaurant_ID`);

ALTER TABLE `categories` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `categories` ADD FOREIGN KEY (`restaurant_ID`) REFERENCES `restaurants`(`restaurant_ID`);

ALTER TABLE `restaurant_menus` ADD FOREIGN KEY (`dishstyle_ID`) REFERENCES `dishstyles`(`dishstyle_ID`);

ALTER TABLE `restaurant_menus` ADD FOREIGN KEY (`category_ID`) REFERENCES `categories`(`category_ID`);

ALTER TABLE `restaurant_menus` ADD FOREIGN KEY (`restaurant_ID`) REFERENCES `restaurants`(`restaurant_ID`);

ALTER TABLE `restaurant_cart` ADD FOREIGN KEY (`restomenu_ID`) REFERENCES `restaurant_menus`(`restomenu_ID`);

ALTER TABLE `restaurant_cart` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `restaurant_cart` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `restaurant_order` ADD FOREIGN KEY (`restomenu_ID`) REFERENCES `restaurant_menus`(`restomenu_ID`);

ALTER TABLE `restaurant_order` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `restaurant_order` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `restaurant_order_total` ADD FOREIGN KEY (`restoorder_ID`) REFERENCES `restaurant_order`(`restoorder_ID`);

ALTER TABLE `restaurant_order_total` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `restaurant_order_total` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guest`(`guest_ID`);

ALTER TABLE `chats` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `chats` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `chats` ADD FOREIGN KEY (`by_admin_id`) REFERENCES `users`(`user_ID`);

ALTER TABLE `notification_chat` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `notification_chat` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `feedbacks` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `feedbacks` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `housekeepings` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `housekeepings` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `offers` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `offers_detail` ADD FOREIGN KEY (`offer_ID`) REFERENCES `offers`(`offer_ID`);

ALTER TABLE `offers_detail` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `places_detail` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `places_detail` ADD FOREIGN KEY (`guest_ID`) REFERENCES `guests`(`guest_ID`);

ALTER TABLE `places_detail` ADD FOREIGN KEY (`adtype_ID`) REFERENCES `places`(`adtype_ID`);

ALTER TABLE `weather` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `notification_all` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `channels` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `appupdate` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);

ALTER TABLE `hotel_access` ADD FOREIGN KEY (`hotel_ID`) REFERENCES `hotels`(`hotel_ID`);


