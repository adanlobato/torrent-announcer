<?php

namespace BitTorrent\Announcer\Client;

class PlainTorrentClient extends Abstracts\TorrentClientAbstract implements Abstracts\TorrentClientInterface
{
    protected $version = 0;

    protected $user_agent = '';
    protected $extra_header = array();

    public function __construct()
    {
    }

    public function generateKey()
    {
        throw new \RuntimeException('invalid generateKey call');
    }

    public function generateId()
    {
        throw new \RuntimeException('invalid generateId call');
    }

    public function getUserAgent()
    {
        if (!$this->user_agent) {
            throw new \RuntimeException('invalid UserAgent');
        }

        return $this->user_agent;

    }

    public function getExtraHeader()
    {
        return $this->extra_header;
    }

    public function setExtraHeader($extra_header)
    {
        $this->extra_header = $extra_header;
    }

    public function supportedVersions()
    {
        throw new \RuntimeException('invalid supportedVersions call');
    }

    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;

        return $this;
    }

    public static function createFromGlobals($array = null)
    {
        if ($array === null) {
            $array = $_GET;
        }

        $self = new static();

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $self->setUserAgent($_SERVER['HTTP_USER_AGENT']);
        }

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            unset($headers['Host']);
            unset($headers['User-Agent']);
            $self->setExtraHeader($headers);
        }

        if (isset($array['peer_id'])) {
            $self->setPeerId($array['peer_id']);
        }

        if (isset($array['port'])) {
            $self->setPeerPort($array['port']);
        }

        if (isset($array['key'])) {
            $self->setPeerKey($array['key']);
        }

        if (isset($array['numwant'])) {
            $self->setNumwant($array['numwant']);
        }

        if (isset($array['compact'])) {
            $self->setCompact($array['compact']);
        }

        if (isset($array['no_peer_id'])) {
            $self->setNoPeerId($array['no_peer_id']);
        }

        return $self;

    }

    public function supportsVersion($version)
    {
        return true;
    }

}
