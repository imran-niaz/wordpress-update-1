<?php
$last_modified = filemtime(__FILE__);
$etag = md5_file(__FILE__);
header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified)." GMT");
header("Etag: $etag");
header("Cache-Control: private");
header("Pragma: cache");

if (isset($_SERVER["HTTP_IF_MODIFIED_SINCE"]) && strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]) >= $last_modified) {
    header("HTTP/1.1 304 Not Modified");
    exit;
}

if (isset($_SERVER["HTTP_IF_NONE_MATCH"]) && $_SERVER["HTTP_IF_NONE_MATCH"] == $etag) {
    header("HTTP/1.1 304 Not Modified");
    exit;
}

// Put your page content here
?>

<script>
function checkForUpdates() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (xmlhttp.responseText == 'updated') {
                location.reload();
            }
        }
    };
    xmlhttp.open("GET", "check-for-updates.php", true);
    xmlhttp.send();
}

setInterval(checkForUpdates, 5000);
</script>
