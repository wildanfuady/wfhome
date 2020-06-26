<?php 
  header('Content-type: application/xml; charset="ISO-8859-1"',true);  
?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc><?= base_url('sitemap/product.xml') ?></loc>
    <lastmod><?= $product['created_at'] ?></lastmod>
  </sitemap>
  <sitemap>
    <loc><?= base_url('sitemap/category.xml') ?></loc>
    <lastmod><?= $category['created_at'] ?></lastmod>
  </sitemap>
  <sitemap>
    <loc><?= base_url('sitemap/page.xml') ?></loc>
    <lastmod><?= $page['created_at'] ?></lastmod>
  </sitemap>
</sitemapindex>