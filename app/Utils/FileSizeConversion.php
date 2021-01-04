<?php


namespace App\Utils;


class FileSizeConversion
{
    /**
     * バイト数をフォーマットする
     * @param integer $bytes
     * @param integer $precision
     * @param array|null $units
     * @return string
     */
    static function formatBytes(int $bytes, $precision = 2, array $units = null): string
    {
        // Not 1024 bytes.
        $static_bytes = 1000;

        if ( abs($bytes) < $static_bytes )
        {
            $precision = 0;
        }

        if ( is_array($units) === false )
        {
            $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        }

        if ( $bytes < 0 )
        {
            $sign = '-';
            $bytes = abs($bytes);
        }
        else
        {
            $sign = '';
        }

        $exp   = floor(log($bytes) / log($static_bytes));
        $unit  = $units[$exp];
        $bytes = $bytes / pow($static_bytes, floor($exp));
        $bytes = sprintf('%.'.$precision.'f', $bytes);
        return $sign.$bytes.' '.$unit;
    }
}
