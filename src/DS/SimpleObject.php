<?php
namespace MiniSkirt\Sugar\DS;

class SimpleObject
{
    protected $storage = [];

    public function __construct($storage = [])
    {
        if (is_array($storage)) $this->storage = $storage;
        if (is_object($storage)) $this->storage = json_decode(json_encode($storage), false);
    }
    public function get(string $item)
    {
        return $this->storage[$item] ?? null;
    }
    public function __get(string $item)
    {
        return $this->get($item);
    }
    public function set(string $item, $value)
    {
        $this->storage[$item] = $value;
    }
    public function __set(string $item, $value)
    {
        $this->storage[$item] = $value;
    }
    public function __isset(string $item): bool
    {
        return $this->has($item);
    }
    public function has(string $item): bool
    {
        return array_key_exists($item, $this->storage);
    }
    public function export($array = false)
    {
        return ($array) ? $this->storage : (object) $this->storage;
    }
    public function __debugInfo(): array
    {
        return $this->storage;
    }
}