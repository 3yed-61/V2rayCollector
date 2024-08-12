<?php

$url = 'https://raw.githubusercontent.com/yebekhe/TVC/main/subscriptions/xray/normal/vmess';
$filePath = 'sub/vmess';

$content = file_get_contents($url);

if ($content !== false) {

    $content = preg_replace('/#profile-title: base64:VFZDIHwgVk1FU1M=.*?#profile-web-page-url: https:\/\/github\.com\/yebekhe\/TelegramV2rayCollector/ms', '', $content);


    $content = preg_replace('/@.*/', '', $content);

    function changeNameInVmessLink($vmessLink) {
        $jsonPart = base64_decode(substr($vmessLink, strpos($vmessLink, '://') + 3));
        $data = json_decode($jsonPart, true);

        if ($data !== null && isset($data['ps'])) {
            $newName = implode(' | ', array_slice(explode(' | ', $data['ps']), 0, 2)) . ' | ⭐3YED';
            $data['ps'] = $newName;
            $newJsonPart = base64_encode(json_encode($data));

            return substr_replace($vmessLink, $newJsonPart, strpos($vmessLink, '://') + 3);
        }

        return $vmessLink;
    }

    $contentLines = explode(PHP_EOL, $content);
    foreach ($contentLines as &$line) {
        if (strpos($line, 'vmess://') === 0) {
            $line = changeNameInVmessLink($line);
        }
    }
    unset($line);

    $headerSections = [
        $warp = "//profile-title: base64:M867zp7EkCDwk4SC8JOGgyBWTUVTU+KtkO+4jw==\n";
    $warp .= "//profile-update-interval: 1\n";
    $warp .= "//subscription-userinfo: upload=5368709120; download=645097156608; total=955630223360; expire=1762677732\n";
    $warp .= "//profile-web-page-url: https://github.com/3yed-61\n\n";
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
