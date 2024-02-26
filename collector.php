<?php

// URL مورد نظر
$url = 'https://raw.githubusercontent.com/yebekhe/TelegramV2rayCollector/main/sub/normal/vmess';

// محتوای لینک را دریافت
$content = file_get_contents($url);

// چک کنید که محتوا با موفقیت دریافت شده است یا خیر
if ($content !== false) {
    // بخش‌های جدید که می‌خواهید در ابتدای فایل قرار بگیرند
    $newSections = [
        '#profile-title: base64:M3llZCB8IFZMRVNT',
        '#profile-update-interval: 1',
        '#subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=2546249531',
        '#profile-web-page-url: https://github.com/nameless4pub/V2rayCollector'
    ];

    // بخش‌های قبلی که می‌خواهید جایگزین شوند
    $oldSections = [
        '#profile-title: base64:VFZDIHwgVk1FU1M=',
        '#profile-update-interval: 1',
        '#subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=2546249531',
        '#support-url: https://t.me/v2raycollector',
        '#profile-web-page-url: https://github.com/yebekhe/TelegramV2rayCollector'
    ];

    // جایگزینی بخش‌های قبلی با بخش‌های جدید
    $content = str_replace($oldSections, $newSections, $content);

    // مسیر ذخیره فایل
    $filePath = 'sub/vmess';

    // محتوا را در فایل ذخیره کنید
    $writeResult = file_put_contents($filePath, $content);

    if ($writeResult !== false) {
        echo 'محتوای لینک با موفقیت دریافت، بخش‌های مشخص شده جایگزین و در ' . $filePath . ' ذخیره شد.';
    } else {
        echo 'خطا در ذخیره محتوا در فایل.';
    }
} else {
    echo 'خطا در دریافت محتوای لینک.';
}
?>
