	
CREATE TABLE `category_kuser`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`category_id` INTEGER  NOT NULL,
	`kuser_id` INTEGER  NOT NULL,
	`puser_id` VARCHAR(100)  NOT NULL,
	`partner_id` INTEGER  NOT NULL,
	`permission_level` TINYINT,
	`status` TINYINT,
	`inherit_from_category` INTEGER,
	`update_method` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`custom_data` TEXT,
	`category_full_ids` TEXT,
	PRIMARY KEY (`id`),
	KEY `partner_id_category_index`(`partner_id`, `category_id`, `status`),
	KEY `partner_id_kuser_index`(`partner_id`, `kuser_id`, `status`)
)ENGINE=InnoDB;
