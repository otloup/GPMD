-- solution 1, with "only_full_group_by" sql mode enabled
SELECT
  prices.price,
  prices.sku,
  cpet.value AS name
FROM (
       SELECT
        SUM(cped.value) AS price
        ,cpe.sku
        ,cpe.entity_id
       FROM catalog_product_entity_decimal AS cped
       LEFT JOIN catalog_product_entity AS cpe ON cpe.entity_id = cped.entity_id
       GROUP BY cped.entity_id
) AS prices
LEFT JOIN catalog_product_entity_text AS cpet ON cpet.entity_id = prices.entity_id;

-- solution 2, without "only_full_group_by" sql mode enabled
SELECT
   SUM(cped.value) AS price
  ,cpe.sku
  ,cpet.value AS name
FROM catalog_product_entity_decimal AS cped
  LEFT JOIN catalog_product_entity AS cpe ON cpe.entity_id = cped.entity_id
  LEFT JOIN catalog_product_entity_text AS cpet ON cpet.entity_id = cped.entity_id
GROUP BY cped.entity_id;

-- solution 3, with disabling "only_full_group_by"
SET @@sql_mode=' ';
SELECT
   SUM(cped.value) AS price
  ,cpe.sku
  ,cpet.value AS name
FROM catalog_product_entity_decimal AS cped
  LEFT JOIN catalog_product_entity AS cpe ON cpe.entity_id = cped.entity_id
  LEFT JOIN catalog_product_entity_text AS cpet ON cpet.entity_id = cped.entity_id
GROUP BY cped.entity_id;