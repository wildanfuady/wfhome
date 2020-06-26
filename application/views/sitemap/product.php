<?php 
  header('Content-type: application/xml; charset="ISO-8859-1"',true);  
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($products as $product) {?>
    <url>
      <loc><?= base_url('produk/'.$product['product_slug']) ?></loc>
      <lastmod><?= $product['created_at'] ?></lastmod>
      <changefreq>daily</changefreq>
      <priority>0.1</priority>
    </url>
    <?php } ?>
</urlset>