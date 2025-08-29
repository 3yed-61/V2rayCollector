<?php

$url = 'https://raw.githubusercontent.com/3yed82/TVC/main/subscriptions/xray/normal/vmess';
$filePath = 'sub/vmess';

// Fetch content from the URL
$content = file_get_contents($url);

if ($content !== false) {

    // Remove content starting with '@'
    $content = preg_replace('/@.*/', '', $content);

    // Function to modify vmess links' "ps" name
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

    // Split the content into lines
    $contentLines = explode(PHP_EOL, $content);

    // Process each line, modify "vmess://" links
    foreach ($contentLines as &$line) {
        if (strpos($line, 'vmess://') === 0) {
            $line = changeNameInVmessLink($line);
        }
    }
    unset($line); // Clean up the reference

    // Define the new header
    $vmess = "//profile-title: base64:M867zp7EkCDwk4SC8JOGgyBWTUVTU+KtkO+4jw==\n";
    $vmess .= "//profile-update-interval: 1\n";
    $vmess .= "//subscription-userinfo: upload=5368709120; download=445097156608; total=955630223360; expire=1762677732\n";
    $vmess .= "//profile-web-page-url: https://github.com/3yed-61\n\n";

    // Generalized regex pattern to remove any existing headers that start with 
    // `//profile-*`, `#profile-*`, `#subscription-*`, or `#support-*`
    $contentWithoutOldHeader = preg_replace('/(\/\/|#)(profile|subscription|support)-(title|update-interval|userinfo|url):.*?\n+/s', '', implode(PHP_EOL, $contentLines));

    // Add the new header and combine with the rest of the content
    $finalContent = $vmess . $contentWithoutOldHeader;

    // Write the modified content to the file
    $writeResult = file_put_contents($filePath, $finalContent);

    if ($writeResult !== false) {
        echo 'Content successfully fetched, existing header removed, and new header added. Content saved in ' . $filePath . '.';
    } else {
        echo 'Error saving content to the file.';
    }
} else {
    echo 'Error fetching content from the link.';
}

?>
