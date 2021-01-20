<?php

declare(strict_types=1);

namespace PiedWeb\LogsAnalyzer\Test;

use PiedWeb\LogsAnalyzer\ApacheLogLine;
use PiedWeb\LogsAnalyzer\LogsAnalyzer;

class LogsAnalyzerTest extends \PHPUnit\Framework\TestCase
{
    public function testLogAnalysis()
    {
        $analyzer = new LogsAnalyzer(ApacheLogLine::class);

        $analyzer->setFilter(function ($line) {
            return false !== stripos($line->getUserAgent(), 'googlebot');
        });
        $results = $analyzer->parse(__DIR__.'/logs');

        $this->assertSame(10, count($results));
    }
}
