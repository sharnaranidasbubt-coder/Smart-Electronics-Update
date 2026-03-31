-- Fix URL Port: Replace localhost:8080 with localhost:4000
-- Run this in phpMyAdmin (http://localhost:4001) or via MySQL command

USE `local`;

-- 1. Update wp_options table (site settings)
UPDATE wp_options SET option_value = REPLACE(option_value, 'localhost:8080', 'localhost:4000') WHERE option_name = 'home' OR option_name = 'siteurl';

-- 2. Update wp_posts table (content, pages, Elementor data)
UPDATE wp_posts SET post_content = REPLACE(post_content, 'localhost:8080', 'localhost:4000');
UPDATE wp_posts SET guid = REPLACE(guid, 'localhost:8080', 'localhost:4000');

-- 3. Update wp_postmeta table (Elementor page builder data, custom fields)
UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'localhost:8080', 'localhost:4000');

-- 4. Update wp_options for all other settings
UPDATE wp_options SET option_value = REPLACE(option_value, 'localhost:8080', 'localhost:4000');

-- Display results
SELECT 'URL replacement completed!' AS Status;
SELECT COUNT(*) AS 'Updated rows in wp_postmeta' FROM wp_postmeta WHERE meta_value LIKE '%localhost:4000%';
