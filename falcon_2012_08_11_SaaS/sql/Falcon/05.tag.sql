
CREATE TABLE `tag`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`tag` VARCHAR(32)  NOT NULL,
	`partner_id` INTEGER  NOT NULL,
	`object_type` INTEGER  NOT NULL,
	`instance_count` INTEGER default 1 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `partner_tag`(`partner_id`),
	KEY `partner_object_tag`(`partner_id`, `object_type`)
)ENGINE=InnoDB;
