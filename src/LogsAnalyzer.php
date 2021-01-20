<?php

namespace PiedWeb\LogsAnalyzer;

class LogsAnalyzer
{
    protected $parser;

    protected $filter;

    protected $logs = [];

    public function __construct(string $type, ?string $domain = null)
    {
        $this->parser = new LogParser();
        $this->parser->setFormat(class_exists($type) ? $type::FORMAT : $type);
        if ($domain !== null) {
            $this->parser->setDomain($domain);
        }
        $this->parser->setType(class_exists($type) ? $type : LogLine::class);
    }

    /**
     * The function must return TRUE for line we want to keep / FALSE for line to ignore
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    protected function checkFile(string $filename): bool
    {
        return ! file_exists($filename) || ! is_readable($filename);
    }

    protected function filter($line)
    {
        if ($this->filter) {
            return call_user_func($this->filter, $line);
        }

        return true;
    }

    public function parse(string $filename): array
    {
        if ($this->checkFile($filename)
           || ($handle = fopen(('.gz' == substr($filename, -3) ? 'compress.zlib://' : '').$filename, 'r')) === false) {
            throw new \Exception('A problem occured with file `'.$filename.'`');
        }

        $lineCounter = 1;
        while (! feof($handle)) {
            $line = fgets($handle);
            $line = $line ? $this->parser->parse($line) : null;
            $this->record($line, $lineCounter);
            ++$lineCounter;
        }
        fclose($handle);

        return $this->logs;
    }

    protected function record($line, $lineCounter)
    {
        if ($line && $this->filter($line)) {
            $this->logs[$lineCounter] = $line;
        }
    }
}
