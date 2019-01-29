<?php

namespace PiedWeb\LogsAnalyzer;

class Filters
{
    public static $cacheIpGoogle;

    public static function googlebot($line)
    {
        return false !== stripos($line->getUserAgent(), 'googlebot');
    }

    /**
     * Strict means we check the ip too.
     */
    public static function googlebotStrict($line)
    {
        if (false !== stripos($line->getUserAgent(), 'googlebot')) {
            if (!isset(self::$cacheIpGoogle[$line->getIp()])) {
                self::$cacheIpGoogle[$line->getIp()] = false !== strpos(gethostbyaddr($line->getIp()), 'googlebot');
            }

            return self::$cacheIpGoogle[$line->getIp()];
        }

        return false;
    }

    public static function bingbot($line)
    {
        return false !== stripos($line->getUserAgent(), 'bingbot');
    }
}
