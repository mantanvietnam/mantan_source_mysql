<?php
function convert_timestamp($timestamp)
{
    $date = date('H:i d/m/Y', $timestamp);
    return $date;
}

function limit_words($string, $word_limit = 15)
{
    $words = explode(" ", $string);
    if (count($words) > $word_limit) {
        $string = implode(" ", array_slice($words, 0, $word_limit)) . '...';
    }
    return $string;
}

function distance_from_now($timestamp)
{
    $now = time();
    $distance = abs($now - $timestamp);
    $seconds_in_day = 24 * 60 * 60;
    $seconds_in_month = 30 * $seconds_in_day;
    $seconds_in_year = 365 * $seconds_in_day;

    if ($distance < $seconds_in_day) {
        $hours = floor($distance / (60 * 60));
        if ($hours == 1) {
            return $hours . ' giờ trước';
        } else {
            return $hours . ' giờ trước';
        }
    } elseif ($distance < $seconds_in_month) {
        $days = floor($distance / $seconds_in_day);
        if ($days == 1) {
            return $days . ' ngày trước';
        } else {
            return $days . ' ngày trước';
        }
    } elseif ($distance < $seconds_in_year) {
        $months = floor($distance / $seconds_in_month);
        if ($months == 1) {
            return $months . ' tháng trước';
        } else {
            return $months . ' tháng trước';
        }
    } else {
        $years = floor($distance / $seconds_in_year);
        if ($years == 1) {
            return $years . ' năm trước';
        } else {
            return $years . ' năm trước';
        }
    }
}
