<?php
namespace BitTorrent\Announcer\Response;

class ScrapeResponse extends Abstracts\ResponseAbstract
{
    public function getFirstFile()
    {
        if (isset($this->response['files']) AND count($this->response['files']) > 0) {
            return current($this->response['files']);
        }

        return false;

    }

    public function getComplete()
    {
        return $this->getFileOption('complete');
    }

    public function getDownloaded()
    {
        return $this->getFileOption('downloaded');
    }

    public function getIncomplete()
    {
        return $this->getFileOption('incomplete');
    }

    public function getName()
    {
        return $this->getFileOption('name');
    }

    private function getFileOption($option)
    {
        if (!$file = $this->getFirstFile() AND !isset($file[$option])) {
            return null;
        }

        return $file[$option];
    }

}
