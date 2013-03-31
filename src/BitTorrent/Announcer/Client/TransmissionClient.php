<?php

namespace BitTorrent\Announcer\Client;

class TransmissionClient extends Abstracts\TorrentClientAbstract implements Abstracts\TorrentClientInterface
{
    /**
     * Big change on 0.8 >=
     *
     * @link: https://trac.transmissionbt.com/wiki/PeerId
     * @var string
     */
    protected $version = '0.6';

    public function getKeyTokens()
    {
        return 'abcdefghijklmnopqrstuvwxyz0123456789';
    }

    public function generateKey()
    {
        return $this->getPeerTokens(8);
    }

    public function generateId()
    {
        if ($this->version == '0.6') {
            return '-TR0006-' . $this->getPeerTokens(12);
        }

        // -TR1330- Official 1.33 release
        // -TR2030- Official 2.03 release
        // -TR2300- Official 2.3 release!?
        list($major, $minor) = explode('.', $this->version);

        return '-TR' . $major . str_pad($minor, 2, '0') . '0-' . $this->getPeerTokens(12);
    }

    public function getUserAgent()
    {
        if ($this->version == '0.6') {
            return 'Transmission/0.6';
        }

        // Transmission/1.32 (6455) Official 1.32 release
        return 'Transmission/' . $this->version;
    }

    public function getExtraHeader()
    {
        return array(
            'Content-length' => '0',
            'Connection' => 'close',
        );
    }

    public function getExtraParameter()
    {
        $parms = array();

        if (version_compare($this->version, '1.5', '>=')) {
            $parms = array(
                'supportcrypto' => 1,
            );
        }

        return $parms;
    }

    public function supportsVersion($version)
    {
        return $version == '0.6' OR version_compare($version, '1', '>=');
    }

}
