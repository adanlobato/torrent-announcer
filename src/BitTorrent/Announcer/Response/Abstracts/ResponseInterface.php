<?php

namespace BitTorrent\Announcer\Response\Abstracts;

interface ResponseInterface
{
    public function setResponse($string);
    public function render();
}
