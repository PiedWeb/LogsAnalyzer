<?php

namespace PiedWeb\LogsAnalyzer;

class LogsResumer extends LogsAnalyzer
{
    protected function record($line, $lineCounter)
    {
        if ($line && $this->filter($line)) {
            $key = $line->getMethod().'+'.$line->getUrl().'+'.$line->getStatus();
            if (! isset($this->logs[$key])) {
                $this->logs[$key] = $line;
            }
            $this->logs[$key]->incrementHit();
        }
    }
}
