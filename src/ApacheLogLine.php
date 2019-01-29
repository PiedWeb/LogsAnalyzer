<?php

namespace PiedWeb\LogsAnalyzer;

class ApacheLogLine extends LogLine
{
    const FORMAT = '%h %l %u %t "%r" %>s %b "%{Referer}i" "%{User-Agent}i"';
}
