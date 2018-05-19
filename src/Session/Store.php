<?php

namespace Rareloop\Lumberjack\Session;

use Illuminate\Support\Arr;
use SessionHandlerInterface;

class Store
{
    protected $name;
    protected $id;
    protected $handler;

    protected $attributes = [];

    public function __construct($name, SessionHandlerInterface $handler, $id)
    {
        $this->setName($name);
        $this->setId($id);

        $this->handler = $handler;
    }

    public function start()
    {
        $this->loadSession();
    }

    protected function loadSession()
    {
        $this->attributes = array_merge($this->attributes, $this->readFromHandler());
    }

    protected function readFromHandler()
    {
        $data = $this->handler->read($this->id);
        $data = @unserialize($data);

        if ($data !== false && ! is_null($data) && is_array($data)) {
            return $data;
        }

        return [];
    }

    public function save()
    {
        $this->ageFlashData();

        $this->handler->write($this->id, @serialize($this->attributes));
    }

    public function put($key, $value)
    {
        Arr::set($this->attributes, $key, $value);
    }

    public function get($key, $default = null)
    {
        return Arr::get($this->attributes, $key, $default);
    }

    public function all()
    {
        return $this->attributes;
    }

    public function has($key)
    {
        return Arr::exists($this->attributes, $key);
    }

    public function pull($key)
    {
        return Arr::pull($this->attributes, $key);
    }

    public function push($key, $value)
    {
        $array = $this->get('key', []);

        $array[] = $value;

        $this->put($key, $array);
    }

    public function forget($key)
    {
        Arr::forget($this->attributes, $key);
    }

    public function flash($key, $value)
    {
        $this->put($key, $value);

        $this->push('_flash.new', $key);
    }

    protected function ageFlashData()
    {
        $this->forget($this->get('_flash.old', []));

        $this->put('_flash.old', $this->get('_flash.new', []));

        $this->put('_flash.new', []);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}