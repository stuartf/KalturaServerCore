
ALTER TABLE kvote
ADD `status` INTEGER,
ADD `partner_id` INTEGER,
ADD `kvote_type` INTEGER default 1,
ADD `custom_data` TEXT,
ADD KEY `entry_user_status_index`(`entry_id`, `kuser_id`, `status`);
