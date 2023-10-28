<?php

function safeDivision($numerator, $denominator) {
    try {
        if ($denominator == 0) {
            return 0;
        }
        return $numerator / $denominator;
    } catch (\Exception $e) {
        return 0;
    }
}

function custom_array_search($array, $searchValue) {
    foreach ($array as $key => $value) {
        if ($value['id'] == $searchValue) {
            return $key;
        }
    }
    return false;
}
