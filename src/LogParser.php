<?php

namespace PiedWeb\LogsAnalyzer;

class LogParser extends \Kassner\LogParser\LogParser
{
    protected $domain;
    protected $type;

    // To be removed when this pull request is accepted : https://github.com/kassner/log-parser/pull/38
    protected $patterns = array(
        '%%' => '(?P<percent>\%)',
        '%a' => '(?P<remoteIp>)',
        '%A' => '(?P<localIp>)',
        '%h' => '(?P<host>[a-zA-Z0-9\-\._:]+)',
        '%l' => '(?P<logname>(?:-|[\w-]+))',
        '%m' => '(?P<requestMethod>OPTIONS|GET|HEAD|POST|PUT|DELETE|TRACE|CONNECT|PATCH|PROPFIND)',
        '%H' => '(?P<requestProtocol>HTTP/(1\.0|1\.1|2\.0))',
        '%p' => '(?P<port>\d+)',
        '%r' => '(?P<request>(?:(?:[A-Z]+) .+? HTTP/(1\.0|1\.1|2\.0))|-|)',
        '%t' => '\[(?P<time>\d{2}/(?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)/\d{4}:\d{2}:\d{2}:\d{2} '.
                '(?:-|\+)\d{4})\]',
        '%u' => '(?P<user>(?:-|[\w\-\.]+))',
        '%U' => '(?P<URL>.+?)',
        '%v' => '(?P<serverName>([a-zA-Z0-9]+)([a-z0-9.-]*))',
        '%V' => '(?P<canonicalServerName>([a-zA-Z0-9]+)([a-z0-9.-]*))',
        '%>s' => '(?P<status>\d{3}|-)',
        '%b' => '(?P<responseBytes>(\d+|-))',
        '%T' => '(?P<requestTime>(\d+\.?\d*))',
        '%O' => '(?P<sentBytes>[0-9]+)',
        '%I' => '(?P<receivedBytes>[0-9]+)',
        '\%\{(?P<name>[a-zA-Z]+)(?P<name2>[-]?)(?P<name3>[a-zA-Z]+)\}i' => '(?P<Header\\1\\3>.*?)',
        '%D' => '(?P<timeServeRequest>[0-9]+)',
        '%S' => '(?P<scheme>http|https)',
    );

    public function setDomain(string $domain)
    {
        $this->domain = $domain;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function parse($line)
    {
        //var_dump($this->pcreFormat); die();
        if (!preg_match($this->pcreFormat, $line, $matches)) {
            throw new \Kassner\LogParser\FormatException($line);
        }

        $entry = $this->createEntry();
        foreach (array_filter(array_keys($matches), 'is_string') as $key) {
            $setter = 'set'.$key;
            if (method_exists($entry, $setter)) {
                $entry->$setter($matches[$key]);
            }
        }

        return $entry;
    }

    /**
     * @return LogLine
     */
    protected function createEntry()
    {
        return null === $this->type ? new LogLine($this->domain) : new $this->type($this->domain);
    }
}
