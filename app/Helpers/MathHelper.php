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
