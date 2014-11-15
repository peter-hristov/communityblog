<?php
    //header("Content-Type: application/rss+xml; charset=ISO-8859-1");
    require 'init.php';

    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>CommunityBlog RSS Feed</title>';
    $rssfeed .= '<link>http://partyplant.eu</link>';
    $rssfeed .= '<description>Just talk about life and stuf...</description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>Copyright (C) 2014 partyplant.eu</copyright>';

    $pdo = (new \core\wrapper\PDOWrapper())->getPDO();

    $statement = $pdo->prepare("Select * From posts ORDER BY created");
    $statement->execute();

    $data = array();
    while ( $row = $statement->fetch(\PDO::FETCH_ASSOC) ) {
        $data[] = $row;
    }

    foreach ($data as $item) {
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $item['title'] . '</title>';
        $rssfeed .= '<description>' . $item['body'] . '</description>';
        $rssfeed .= '<link>'.'index.php?page=Posts&action=view&id='.$item['id'].'</link>';
        $rssfeed .= '<pubDate>' . $item['created'] . '</pubDate>';
        $rssfeed .= '</item>';
    }

    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';

    echo $rssfeed;
?>