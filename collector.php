<?php

$url = 'https://raw.githubusercontent.com/yebekhe/TVC/main/subscriptions/xray/normal/tuic';
$filePath = 'sub/tuic';

$content = file_get_contents($url);

if ($content !== false) {
    // Remove the unwanted header sections
    $content = preg_replace('/#profile-title: base64:VFZDIHwgVk1FU1M=.*?#profile-web-page-url: https:\/\/github\.com\/yebekhe\/TelegramV2rayCollector/ms', '', $content);

    // Remove everything after the @ symbol
    $content = preg_replace('/@.*/', '', $content);

    function changeNameInTuicLink($tuicLink) {
        // Extracting name from the link
        $pattern = '/\|([^|]+)@TUICity[^|]+\|/';
        preg_match($pattern, $tuicLink, $matches);

        if (!empty($matches[1])) {
            $nameToRemove = '|%20@' . $matches[1] . '%20|';
            return str_replace($nameToRemove, '', $tuicLink);
        }

        return $tuicLink;
    }

    $contentLines = explode(PHP_EOL, $content);
    foreach ($contentLines as &$line) {
        if (strpos($line, 'tuic://') === 0) {
            $line = changeNameInTuicLink($line);
        }
    }
    unset($line);

    $headerSections = [
        '#profile-title: base64:M1lFRCDik4IgfCBWTUVTUw==',
        '#profile-update-interval: 1',
        '#subscription-userinfo: upload=0; download=0; total=10737418240000000; expire=2546249531',
        '#profile-web-page-url: https://github.com/nameless4pub'
    ];

    $content = implode(PHP_EOL, $headerSections) . PHP_EOL . implode(PHP_EOL, $contentLines);

    $writeResult = file_put_contents($filePath, $content);

    if ($writeResult !== false) {
        echo 'Content successfully fetched and specified sections replaced. Content saved in ' . $filePath . '.';
    } else {
        echo 'Error saving content to the file.';
    }
} else {
    echo 'Error fetching content from the link.';
}
?>
