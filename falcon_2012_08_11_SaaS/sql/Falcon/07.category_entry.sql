CREATE TABLE `category_entry`
(
        `id` INTEGER  NOT NULL AUTO_INCREMENT,
        `partner_id` INTEGER  NOT NULL,
        `entry_id` VARCHAR(20),
        `category_id` INTEGER,
        `created_at` DATETIME,
        `custom_data` TEXT,
        `updated_at` DATETIME,
        `category_full_ids` TEXT  NOT NULL,
        `status` INTEGER DEFAULT 2,
        PRIMARY KEY (`id`),
        KEY `partner_id_index`(`partner_id`),
        KEY `category_id_index`(`category_id`),
        KEY `entry_id_index`(`entry_id`),
        KEY `updated_at`(`updated_at`)
)ENGINE=InnoDB;
