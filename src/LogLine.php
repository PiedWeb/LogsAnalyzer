<?php

namespace PiedWeb\LogsAnalyzer;

class LogLine
{
    protected $ip;
    protected $logname;
    protected $user;
    protected $date;
    protected $time;
    protected $domain;
    protected $method;
    protected $url;
    protected $httpVersion;
    protected $status;
    protected $responseBytes;
    protected $referer;
    protected $useragent;
    protected $hit;

    public function __construct(?string $domain = null)
    {
        $this->domain = $domain;
    }

    public function getKeys()
    {
        return array_keys(get_object_vars($this));
    }

    public function get()
    {
        return array_values(get_object_vars($this));
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setHost($ip)
    {
        $this->setIp($ip);
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getLogname()
    {
        return $this->logname;
    }

    public function setLogname($logname)
    {
        if ('-' != $logname) {
            $this->logname = $logname;
        }
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        if ('-' != $user) {
            $this->user = $user;
        }
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        list($date, $time) = explode(':', $time, 2);
        $this->time = $time;

        $date = \DateTime::createFromFormat('j/M/Y', $date);
        $this->date = $date->format('Ymd');
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setRequest($request)
    {
        $request = str_replace(['http://'.$this->domain.'/', 'https://'.$this->domain.'/'], '/', $request);
        list($method, $url, $httpVersion) = explode(' ', $request);
        $this->setMethod($method);
        $this->setUrl($url);
        $this->setHttpVersion($httpVersion);
    }

    public function getHttpVersion()
    {
        return $this->httpVersion;
    }

    public function setHttpVersion($httpVersion)
    {
        $this->httpVersion = $httpVersion;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getResponseBytes()
    {
        return $this->responseBytes;
    }

    public function setResponseBytes($responseBytes)
    {
        $this->responseBytes = $responseBytes;
    }

    public function getReferer()
    {
        return $this->referer;
    }

    protected function isInternalReferer($referer)
    {
        return 0 === strpos($referer, 'http://'.$this->domain) || 0 === strpos($referer, 'https://'.$this->domain);
    }

    public function setHeaderReferer($referer)
    {
        if (!empty($referer) && '-' != $referer) {
            $this->setReferer($referer);
        }
    }

    public function setReferer($referer)
    {
        $referer = $this->isInternalReferer($referer) ? null : $referer;

        $this->referer = $referer;
    }

    public function getUseragent()
    {
        return $this->useragent;
    }

    public function setHeaderUserAgent($useragent)
    {
        $this->setUserAgent($useragent);
    }

    public function setUseragent($useragent)
    {
        $this->useragent = $useragent;
    }

    public function getHit()
    {
        return $this->hit ?? 1;
    }

    public function incrementHit()
    {
        $this->hit++;
    }

    public function ipAdressNumber($dotted)
    {
        $dotted = preg_split('/[.]+/', $dotted);

        return (float) ($dotted[0] * 16777216) + ($dotted[1] * 65536) + ($dotted[2] * 256) + ($dotted[3]);
    }
}
