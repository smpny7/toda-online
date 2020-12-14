<?php


namespace App\Utils;


class TimeConversion
{
    public static function fromSecondsToMinutes(int $time): string
    {
        $minutes = floor(($time / 60) % 60);
        $seconds = $time % 60;
        return sprintf('%02d', $minutes) . ':'. sprintf('%02d', $seconds);
    }
}
