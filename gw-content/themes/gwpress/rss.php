<?php echo '<'.'?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';?>
<?php header("Content-type: text/xml"); ?>
<rss version="2.0">
    <channel>
        <title><?php echo SITE_TITLE; ?></title>
        <link><?php echo BASE_URL; ?></link>
        <description><?php echo SITE_HEADLINE; ?></description>
        <?php
        $posts = db_query("SELECT * FROM post WHERE status = 1 ORDER BY id DESC LIMIT 20");
        foreach($posts as $post) { ?>
            <item>
                <title><?php echo $post['title']; ?></title>
                <link><?php echo BASE_URL; ?>/blog/<?php echo $post['id']; ?>/<?php echo $post['slug']; ?>/</link>
                <guid><?php echo BASE_URL; ?>/blog/<?php echo $post['id']; ?>/<?php echo $post['slug']; ?>/</guid>
                <description><![CDATA[<?php
                    $body = substr($post['body'],0,250);
                    $bodyreplace = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $body);
                    echo strip_tags($bodyreplace); ?>...]]></description>
            </item>
        <?php } ?>
    </channel>
</rss>