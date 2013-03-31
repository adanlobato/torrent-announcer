<?php

namespace BitTorrent\Announcer\Client;

class BitTornadoClient extends Abstracts\TorrentClientAbstract implements Abstracts\TorrentClientInterface
{
    protected $version = '0.3.18';

    public function generateKey()
    {
        return $this->getPeerTokens(6);
    }

    protected function getKeyTokens()
    {
        return 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    }

    public function generateId()
    {
        return 'T03I-----' . $this->getPeerTokens(11);
    }

    public function getUserAgent()
    {
        return 'BitTornado/T-0.3.18';
    }

    public function getExtraHeader()
    {
        return array(
            'Accept-Encoding' => 'gzip',
        );
    }

    public function supportsVersion($version)
    {
        return in_array($version, array('0.3.18'));
    }

}
