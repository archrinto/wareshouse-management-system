<?php

use Carbon\Carbon;

if (!function_exists('format_date')) {
    function format_date($timestamp) {
        if (!$timestamp) return 'n/a';
        $format = 'l, d F Y';
        if (is_numeric($timestamp)){
            return date($format, $timestamp) ?? 'n/a';
        }
        return Carbon::parse($timestamp)->format($format) ?? 'n/a';
    }
}

if (!function_exists('format_datetime')) {
    function format_datetime(string $timestamp) {
        if (!$timestamp) return 'n/a';
        $format = 'l, d F Y H:i';
        if (is_numeric($timestamp)){
            return date($format, $timestamp) ?? 'n/a';
        }
        return Carbon::parse($timestamp)->format($format) ?? 'n/a';
    }
}
