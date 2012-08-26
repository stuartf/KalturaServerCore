
ALTER TABLE entry
ADD `creator_kuser_id` INTEGER;
	
UPDATE entry 
SET creator_kuser_id = kuser_id 
WHERE STATUS <> 3;