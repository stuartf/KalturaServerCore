
ALTER TABLE `bulk_upload_result` 
ADD `status` INTEGER,
ADD `object_status` INTEGER,
ADD `object_error_description` VARCHAR(255),
ADD `error_code` INTEGER,
ADD `error_type` INTEGER,
MODIFY `object_type` INT DEFAULT 1;


