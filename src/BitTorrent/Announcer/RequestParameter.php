<?php

namespace BitTorrent\Announcer;

class RequestParameter
{
    const EVENT_START = 'started';
    const EVENT_UPDATE = 'update';
    const EVENT_STOP = 'stopped';
    const EVENT_COMPLETE = 'completed';

    private $parameters = array(
        'uploaded' => 0,
        'downloaded' => 0,
        'left' => 0,
        'info_hash' => null,
        'event' => self::EVENT_START,
    );

    public function setInfoHash($value)
    {
        if (strlen($value) != 40 OR !preg_match("/^[a-f0-9]{1,}$/is", $value)) {
            throw new \RuntimeException('invalid info_hash given');
        }

        return $this->set('info_hash', $value);
    }

    public function getInfoHash()
    {
        return $this->get('info_hash');
    }

    public function setEvent($value)
    {
        return $this->set('event', $value);
    }

    public function getEvent()
    {
        return $this->get('event', 'update');
    }

    public function setDownloaded($value)
    {
        return $this->set('downloaded', $value);
    }

    public function getDownloaded()
    {
        return $this->get('downloaded');
    }

    public function setLeft($value)
    {
        return $this->set('left', $value);
    }

    public function getLeft()
    {
        return $this->get('left');
    }

    public function setUploaded($value)
    {
        return $this->set('uploaded', $value);
    }

    public function getUploaded()
    {
        return $this->get('uploaded');
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters($parameters)
    {
        if (isset($parameters['info_hash']) && !preg_match("/^[a-f0-9]{1,}$/is", $parameters['info_hash'])) {
            $parameters['info_hash'] = current(unpack('H*', $parameters['info_hash']));
        }

        $this->parameters = $parameters;

        return $this;
    }

    public function toArray()
    {
        $parameter = array(
            'info_hash' => $this->getInfoHash(),
            'uploaded' => $this->getUploaded(),
            'downloaded' => $this->getDownloaded(),
            'left' => $this->getLeft(),
        );

        if ($this->getEvent() && $this->getEvent() != self::EVENT_UPDATE) {
            $parameter['event'] = $this->getEvent();
        }

        return $parameter;
    }

    public function set($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    public static function createFromArray($array)
    {
        $self = new static();
        $self->setParameters($array);

        return $self;
    }

    public function get($key, $default = null)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : $default;
    }

}
