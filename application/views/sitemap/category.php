<?php 
  header('Content-type: application/xml; charset="ISO-8859-1"',true);  
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($categories as $category) {?>
    <url>
      <loc><?= base_url('kategori/'.$category['category_slug']) ?></loc>
      <lastmod><?= $category['created_at'] ?></lastmod>
      <changefreq>daily</changefreq>
      <priority>0.1</priority>
    </url>
    <?php } ?>
</urlset>