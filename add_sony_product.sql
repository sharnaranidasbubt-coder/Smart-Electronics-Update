-- Add Sony BRAVIA XR-55A80L Product
-- Create product with specifications, image, and categories

USE `local`;

-- Step 1: Insert Product Post
INSERT INTO wp_posts (
    post_author,
    post_date,
    post_date_gmt,
    post_content,
    post_title,
    post_excerpt,
    post_status,
    comment_status,
    ping_status,
    post_password,
    post_name,
    to_ping,
    pinged,
    post_modified,
    post_modified_gmt,
    post_content_filtered,
    post_parent,
    guid,
    menu_order,
    post_type,
    post_mime_type,
    comment_count
) VALUES (
    1,                                                                  -- author ID
    NOW(),                                                              -- post date
    UTC_TIMESTAMP(),                                                    -- GMT date
    '<h2>Sony BRAVIA XR-55A80L - 55 inch OLED 4K Smart TV</h2>
<p>Experience the future of television with Sony BRAVIA XR-55A80L. Featuring Cognitive Processor XR, this OLED TV delivers perfect blacks and infinite contrast for an immersive viewing experience.</p>

<h3>Key Features:</h3>
<ul>
<li><strong>Screen Size:</strong> 55 inches</li>
<li><strong>Panel Type:</strong> OLED</li>
<li><strong>Key Technology:</strong> Cognitive Processor XR</li>
<li><strong>Display:</strong> 4K Ultra HD (3840 x 2160)</li>
<li><strong>Key Feature:</strong> Perfect blacks, infinite contrast</li>
<li><strong>Smart TV:</strong> Android TV with Google TV</li>
<li><strong>Sound:</strong> Acoustic Surface Audio+</li>
<li><strong>Dolby Atmos:</strong> Yes</li>
<li><strong>HDR:</strong> Dolby Vision, HDR10, HLG</li>
</ul>

<h3>What\'s in the Box:</h3>
<ul>
<li>Sony BRAVIA XR-55A80L TV</li>
<li>Remote Control</li>
<li>Power Cable</li>
<li>User Manual</li>
<li>Warranty Card</li>
</ul>', -- product description
    'Sony BRAVIA XR-55A80L 55 inch OLED 4K Smart TV',                  -- product title
    '55" OLED TV with Cognitive Processor XR - Perfect blacks and infinite contrast. 2 Years Sony Official Warranty.', -- short description
    'publish',                                                          -- status
    'open',                                                             -- comment status
    'closed',                                                           -- ping status
    '',                                                                 -- password
    'sony-bravia-xr-55a80l-55-inch-oled-4k-smart-tv',                   -- slug
    '',                                                                 -- to_ping
    '',                                                                 -- pinged
    NOW(),                                                              -- modified
    UTC_TIMESTAMP(),                                                    -- modified GMT
    '',                                                                 -- content_filtered
    0,                                                                  -- parent
    '',                                                                 -- guid
    0,                                                                  -- menu_order
    'product',                                                          -- post type
    '',                                                                 -- mime_type
    0                                                                   -- comment_count
);

-- Get the new product ID
SET @product_id = LAST_INSERT_ID();

-- Step 2: Insert Product Meta Data
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(@product_id, '_sku', 'SONY-XR-55A80L'),
(@product_id, '_regular_price', '265000'),
(@product_id, '_price', '265000'),
(@product_id, '_sale_price', ''),
(@product_id, '_manage_stock', 'no'),
(@product_id, '_stock_status', 'instock'),
(@product_id, '_virtual', 'no'),
(@product_id, '_downloadable', 'no'),
(@product_id, '_wc_average_rating', '0'),
(@product_id, '_wc_review_count', '0'),
(@product_id, 'total_sales', '0'),
(@product_id, '_product_version', '7.7.2'),
(@product_id, '_wp_old_slug', 'sony-bravia-xr-55a80l');

-- Step 3: Insert Product Specifications (Custom Fields)
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(@product_id, 'screen_size', '55 inches'),
(@product_id, 'panel_type', 'OLED'),
(@product_id, 'key_technology', 'Cognitive Processor XR'),
(@product_id, 'key_feature', 'Perfect blacks, infinite contrast'),
(@product_id, 'display_resolution', '4K Ultra HD (3840 x 2160)'),
(@product_id, 'smart_tv_platform', 'Android TV with Google TV'),
(@product_id, 'sound_system', 'Acoustic Surface Audio+'),
(@product_id, 'dolby_atmos', 'Yes'),
(@product_id, 'hdr_support', 'Dolby Vision, HDR10, HLG'),
(@product_id, 'emi_price', '22,083/month'),
(@product_id, 'warranty', '2 Years Sony Official Warranty');

-- Step 4: Add Product Attributes (Visual Composer/WoodMart format)
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(@product_id, '_product_attributes', 'a:1:{s:8:\"pa_brand\";a:6:{s:4:\"name\";s:8:\"pa_brand\";s:5:\"value\";s:4:\"Sony\";s:11:\"is_taxonomy\";i:1;s:7:\"position\";i:0;s:13:\"is_visible\";i:1;s:12:\"is_variation\";i:0;}}');

-- Step 5: Link Product to Categories
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id) VALUES
(@product_id, 144), -- BRAVIA XR Series
(@product_id, 142), -- Sony Televisions
(@product_id, 45);  -- Televisions

-- Step 6: Update Category Counts
UPDATE wp_term_taxonomy SET count = count + 1 WHERE term_id IN (45, 142, 144);

-- Step 7: Register the Image Attachment
-- First, check if image already exists
SET @image_id = (SELECT ID FROM wp_posts WHERE post_title LIKE '%sony tv%' AND post_type = 'attachment' LIMIT 1);

-- If image doesn't exist, insert it
INSERT IGNORE INTO wp_posts (
    post_author,
    post_date,
    post_date_gmt,
    post_content,
    post_title,
    post_excerpt,
    post_status,
    comment_status,
    ping_status,
    post_password,
    post_name,
    to_ping,
    pinged,
    post_modified,
    post_modified_gmt,
    post_content_filtered,
    post_parent,
    guid,
    menu_order,
    post_type,
    post_mime_type,
    comment_count
) VALUES (
    1,
    NOW(),
    UTC_TIMESTAMP(),
    '',
    'Sony TV',
    '',
    'inherit',
    'open',
    'closed',
    '',
    'sony-tv',
    '',
    '',
    NOW(),
    UTC_TIMESTAMP(),
    '',
    0,
    'http://localhost:8080/wp-content/uploads/2026/03/sony-tv.png',
    0,
    'attachment',
    'image/png',
    0
);

SET @attachment_id = LAST_INSERT_ID();

-- Step 8: Add Image Metadata
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(@attachment_id, '_wp_attached_file', '2026/03/sony-tv.png'),
(@attachment_id, '_wp_attachment_metadata', 'a:6:{s:5:"width";i:1920;s:6:"height";i:1080;s:4:"file";s:20:"2026/03/sony-tv.png";s:8:"filesize";i:1621664;s:5:"sizes";a:3:{s:9:"thumbnail";a:4:{s:4:"file";s:20:"sony-tv-150x150.png";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:9:"image/png";}s:6:"medium";a:4:{s:4:"file";s:20:"sony-tv-300x300.png";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:9:"image/png";}s:12:"medium_large";a:4:{s:4:"file";s:22:"sony-tv-768x768.png";s:5:"width";i:768;s:6:"height";i:768;s:9:"mime-type";s:9:"image/png";}}s:10:"image_meta";a:12:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";s:11:"orientation";s:1:"0";s:8:"keywords";a:0:{}}}');

-- Step 9: Link Image to Product (Featured Image)
UPDATE wp_posts SET post_parent = @product_id WHERE ID = @attachment_id;
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(@product_id, '_thumbnail_id', @attachment_id);

-- Display Results
SELECT
    'Product Created Successfully!' AS Status,
    @product_id AS Product_ID,
    (SELECT post_title FROM wp_posts WHERE ID = @product_id) AS Product_Name,
    (SELECT meta_value FROM wp_postmeta WHERE post_id = @product_id AND meta_key = '_regular_price') AS Price,
    (SELECT meta_value FROM wp_postmeta WHERE post_id = @product_id AND meta_key = 'screen_size') AS Screen_Size,
    @attachment_id AS Image_ID;

-- Display Product Details
SELECT
    p.ID AS Product_ID,
    p.post_title AS Product_Name,
    pm1.meta_value AS SKU,
    pm2.meta_value AS Price,
    pm3.meta_value AS Screen_Size,
    pm4.meta_value AS Panel_Type,
    pm5.meta_value AS Warranty,
    t.name AS Category
FROM wp_posts p
LEFT JOIN wp_postmeta pm1 ON p.ID = pm1.post_id AND pm1.meta_key = '_sku'
LEFT JOIN wp_postmeta pm2 ON p.ID = pm2.post_id AND pm2.meta_key = '_regular_price'
LEFT JOIN wp_postmeta pm3 ON p.ID = pm3.post_id AND pm3.meta_key = 'screen_size'
LEFT JOIN wp_postmeta pm4 ON p.ID = pm4.post_id AND pm4.meta_key = 'panel_type'
LEFT JOIN wp_postmeta pm5 ON p.ID = pm5.post_id AND pm5.meta_key = 'warranty'
LEFT JOIN wp_term_relationships tr ON p.ID = tr.object_id
LEFT JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
LEFT JOIN wp_terms t ON tt.term_id = t.term_id
WHERE p.ID = @product_id;
