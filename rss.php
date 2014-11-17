<?php
    //header("Content-Type: application/rss+xml; charset=ISO-8859-1");
    require 'init.php';

    $rssfeed = '<?xml version="1.0" encoding="UTF8"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>CommunityBlog RSS Feed</title>';
    $rssfeed .= '<link>http://partyplant.eu</link>';
    $rssfeed .= '<description>Just talk about life and stuf...</description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>Copyright (C) 2014 partyplant.eu</copyright>';

    $statement = app\model\Ubermodel::$pdo->prepare("Select * From posts ORDER BY created");
    $statement->execute();

    while ( $row = $statement->fetch(\PDO::FETCH_ASSOC) ) {
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $row['title'] . '</title>';
        $rssfeed .= '<description>' . $row['body'] . '</description>';
        $rssfeed .= '<link>'.'index.php?page=Posts&action=view&id='.$row['id'].'</link>';
        $rssfeed .= '</item>';
    }

    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';

    echo $rssfeed;
?>