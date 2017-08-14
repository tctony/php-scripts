#!/usr/bin/env php
<?php
if ($argc == 1) {
    echo 'Usage: git-hash-object.php input-file';
    exit(-1);
}

$content = @file_get_contents($argv[1]);
if (strlen($content) == 0) {
    echo "$argv[1] is not exist or an empty file.\n";
    exit;
}

$store = sprintf("blob %d\0%s", strlen($content), $content);

$hash = sha1($store);
echo $hash . "\n";

file_put_contents($hash, zlib_encode($store, ZLIB_ENCODING_DEFLATE, 6));
