<?php echo '<'.'?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';?>
<?php header("Content-type: text/xml"); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo BASE_URL;?></loc>
        <lastmod><?php echo date("Y-m-d\TH:i:sP"); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <?php
    $categories = db_query("SELECT * FROM category");
    foreach ($categories as $category) { ?>
        <url>
            <loc><?php echo BASE_URL;?>/blog/category/<?php echo $category['id']; ?>/<?php echo $category['slug']; ?></loc>
            <lastmod><?php echo date("Y-m-d\TH:i:sP"); ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    <?php } ?>
    <?php
    $posts = db_query("SELECT * FROM post");
    foreach ($posts as $post) { ?>
        <url>
            <loc><?php echo BASE_URL;?>/blog/<?php echo $post['id']; ?>/<?php echo $post['slug']; ?></loc>
            <?php
            $created_date = $post['updated_date'];
            $formatted_date = date("Y-m-d\TH:i:sP", strtotime($created_date));
            ?>
            <lastmod><?php echo $formatted_date; ?></lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    <?php } ?>
    <?php
    $pages = db_query("SELECT * FROM page");
    foreach ($pages as $page) { ?>
        <url>
            <loc><?php echo BASE_URL;?><?php echo $page['slug']; ?></loc>
            <lastmod><?php echo date("Y-m-d\TH:i:sP"); ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    <?php } ?>
    <url>
        <loc><?php echo BASE_URL;?>contact</loc>
        <lastmod><?php echo date("Y-m-d\TH:i:sP"); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
</urlset>