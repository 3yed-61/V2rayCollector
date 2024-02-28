<?php

$url = "https://raw.githubusercontent.com/yebekhe/TVC/main/subscriptions/xray/normal/tuic";
$content = file_get_contents($url);

if ($content !== false) {
   
    $content = str_replace("#profile-title: base64:VFZDIHwgVFVJQw==", "#profile-title: base64:M1lFRCDik4IgfCBWTUVTUw==", $content);
    $content = str_replace("#profile-web-page-url: https://github.com/yebekhe/TelegramV2rayCollector", "#profile-web-page-url: https://github.com/nameless4pub", $content);

    
    file_put_contents("export/tuic.txt", $content);
    echo "Content successfully saved.";
} else {
    echo "Error fetching content.";
}
?>
