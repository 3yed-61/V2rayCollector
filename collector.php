<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = "https://raw.githubusercontent.com/yebekhe/TVC/main/subscriptions/xray/normal/tuic";
$content = file_get_contents($url);

if ($content !== false) {
    // حذف قسمت‌های مورد نظر
    $content = str_replace("#profile-title: base64:VFZDIHwgVFVJQw==", "#profile-title: base64:M1lFRCDik4IgfCBWTUVTUw==", $content);
    $content = str_replace("#profile-web-page-url: https://github.com/yebekhe/TelegramV2rayCollector", "#profile-web-page-url: https://github.com/nameless4pub", $content);

    // ذخیره محتوا در یک فایل
    file_put_contents("export/tuic", $content);
    echo "محتوا با موفقیت ذخیره شد.";
} else {
    echo "خطا در دریافت محتوا.";
}
?>
