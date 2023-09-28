<?php
function parseHTML($html) {
    $stack = [];
    $tags = [];
    preg_match_all("|<[^>]+>(.*)</[^>]+>|U", $html, $tags, PREG_PATTERN_ORDER);
    print_r($tags);
    foreach ($tags[0] as $tag) {
        preg_match("|^<([^/][^>]*)>|U", $tag, $openTag);

        preg_match("|</([^>]*)>$|U", $tag, $closeTag);
        
        print_r($openTag);
        print_r($closeTag);


        if (!empty($openTag)) {
            array_push($stack, $openTag[1]);
        }
        if (!empty($closeTag)) {
            if (end($stack) === $closeTag[1]) {
                array_pop($stack);
            } else {
                throw new Exception('Missing open tag for ' . $closeTag[1]);
            }
        }
    }
    if (!empty($stack)) {
        throw new Exception('Missing close tag for ' . end($stack));
    }
}

try {
    parseHTML('<html><body><div><a></a></div></body></html>');
    echo "Parsed successfully\n";
} catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}

// try {
//     parseHTML('<html><body><div></a></body></html>');
//     echo "Parsed successfully\n";
// } catch (Exception $e) {
//     echo 'Error: ',  $e->getMessage(), "\n";
// }
?>