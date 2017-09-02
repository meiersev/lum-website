<?php
function rgbDecValues($hex) {
    if (strlen($hex) != 7) { return $hex; }
    // Split hex value into parts
    $hex = str_replace('#', '', $hex);
    $rgb_array = str_split($hex, 2);
    return array_map(hexdec, $rgb_array);
}

function adjustBrightness($hex, $percentage) {
    if (strlen($hex) != 7) { return $hex; }
    $rgb_array = rgbDecValues($hex);

    $result = '#';
    foreach ($rgb_array as $color) {
        $color = max(0, min(255, $color + ($percentage * $color)));
        $result .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT);
    }
    return $result;
}

function wbComplementSelect($hex) {
    if (strlen($hex) != 7) { return $hex; }
    $rgb_array = rgbDecValues($hex);
    $average = array_sum($rgb_array) / 3;
    if ($average > 128) {
        return '#000000';
    } else {
        return '#ffffff';
    }
}
?>
