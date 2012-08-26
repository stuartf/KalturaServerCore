
ALTER TABLE `syndication_feed` 
ADD `privacy_context` VARCHAR(255),
ADD `enforce_entitlement` TINYINT default 1;
