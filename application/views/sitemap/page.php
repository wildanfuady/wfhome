<?php 
  header('Content-type: application/xml; charset="ISO-8859-1"',true);  
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($pages as $page) {?>
    <url>
      <loc><?= base_url('page/'.$page['page_slug']) ?></loc>
      <lastmod><?= $page['created_at'] ?></lastmod>
      <changefreq>daily</changefreq>
      <priority>0.1</priority>
    </url>
    <?php } ?>
</urlset>