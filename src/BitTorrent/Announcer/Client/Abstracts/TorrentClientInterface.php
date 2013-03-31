<?php

namespace BitTorrent\Announcer\Client\Abstracts;

interface TorrentClientInterface
{
    public function getUserAgent();
    public function getExtraHeader();
    public function generateKey();
    public function generateId();

    public function supportsVersion($version);

    public function setVersion($version);
    public function getVersion();
    public function setPeerId($peer_id);
    public function getPeerId();
    public function setPeerKey($peer_key);
    public function getPeerKey();
    public function setPeerPort($peer_port);
    public function getPeerPort();

    public function setCompact($compact);
    public function getCompact();
    public function setNoPeerId($no_peer_id);
    public function getNoPeerId();
    public function setNumwant($numwant);
    public function getNumwant();

}
