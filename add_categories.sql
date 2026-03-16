-- Add Categories and Subcategories for Smart Electronics
-- Run this in phpMyAdmin or via command line

USE `local`;

-- 1. Add Parent Category "Electronics"
INSERT INTO wp_terms (name, slug, term_group)
VALUES ('Electronics', 'electronics', 0);

-- Get the term_id
SET @electronics_id = LAST_INSERT_ID();

-- 2. Add Taxonomy for "Electronics"
INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count)
VALUES (@electronics_id, 'product_cat', 'Electronic devices and accessories', 0, 0);

-- 3. Add Subcategory "Mobile Phones"
INSERT INTO wp_terms (name, slug, term_group)
VALUES ('Mobile Phones', 'mobile-phones', 0);

SET @mobile_id = LAST_INSERT_ID();

-- 4. Add Taxonomy for "Mobile Phones" (child of Electronics)
INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count)
VALUES (@mobile_id, 'product_cat', 'Smartphones and mobile devices', @electronics_id, 0);

-- 5. Add Subcategory "Laptops"
INSERT INTO wp_terms (name, slug, term_group)
VALUES ('Laptops', 'laptops', 0);

SET @laptops_id = LAST_INSERT_ID();

-- 6. Add Taxonomy for "Laptops" (child of Electronics)
INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count)
VALUES (@laptops_id, 'product_cat', 'Laptop computers', @electronics_id, 0);

-- 7. Add Subcategory "Accessories"
INSERT INTO wp_terms (name, slug, term_group)
VALUES ('Accessories', 'accessories', 0);

SET @accessories_id = LAST_INSERT_ID();

-- 8. Add Taxonomy for "Accessories" (child of Electronics)
INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count)
VALUES (@accessories_id, 'product_cat', 'Electronic accessories', @electronics_id, 0);

-- Display results
SELECT
    t.name AS 'Category Name',
    t.slug AS 'Slug',
    tt.parent AS 'Parent ID',
    (SELECT name FROM wp_terms WHERE term_id = tt.parent) AS 'Parent Category'
FROM wp_terms t
JOIN wp_term_taxonomy tt ON t.term_id = tt.term_id
WHERE tt.taxonomy = 'product_cat'
ORDER BY tt.parent, t.name;
