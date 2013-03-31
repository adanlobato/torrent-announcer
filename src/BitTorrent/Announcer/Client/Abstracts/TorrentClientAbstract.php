<?php

namespace BitTorrent\Announcer\Client\Abstracts;

abstract class TorrentClientAbstract implements TorrentClientInterface
{
    protected $peer_id;
    protected $peer_key;
    protected $peer_port = 3366 ;

    protected $no_peer_id = 1;
    protected $compact = 1;
    protected $numwant = 50;

    protected $version;

    public function __construct($version = null)
    {
        // setVersion will regenerate keys
        if ($version !== null) {
            $this->setVersion($version);
        } else {
            $this->initRandomKeys();
        }

    }

    public function initRandomKeys()
    {
        $this->peer_id = $this->generateId();
        $this->peer_key = $this->generateKey();

        return $this;
    }

    protected function getKeyTokens()
    {
        return 'abcdef0123456789';
    }

    protected function getPeerTokens($length)
    {
        $tokens = '';

        mt_srand((double) microtime() * 1000000);

        for ($i = 1; $i <= $length; $i++) {
            $tokens .= substr($this->getKeyTokens(), mt_rand(0, strlen($this->getKeyTokens()) - 1), 1);
        }

        return $tokens;
    }

    public function setVersion($version)
    {
        if (!$this->supportsVersion($version)) {
            throw new \RuntimeException('Unknown version string: ' . $version);
        }

        $this->version = $version;

        $this->initRandomKeys();

        return $this;
    }

    public function getVersion()
    {
        $this->version;
    }

    public function setPeerId($peer_id)
    {
        $this->peer_id = $peer_id;
    }

    public function getPeerId()
    {
        return $this->peer_id;
    }

    public function setPeerKey($peer_key)
    {
        $this->peer_key = $peer_key;
    }

    public function getPeerKey()
    {
        return $this->peer_key;
    }

    public function setPeerPort($peer_port)
    {
        $this->peer_port = $peer_port;
    }

    public function getPeerPort()
    {
        return $this->peer_port;
    }

    public function setCompact($compact)
    {
        $this->compact = $compact;

        return $this;
    }

    public function getCompact()
    {
        return $this->compact;
    }

    public function setNoPeerId($no_peer_id)
    {
        $this->no_peer_id = $no_peer_id;

        return $this;
    }

    public function getNoPeerId()
    {
        return $this->no_peer_id;
    }

    public function setNumwant($numwant)
    {
        $this->numwant = $numwant;
    }

    public function getNumwant()
    {
        return $this->numwant;
    }

}
