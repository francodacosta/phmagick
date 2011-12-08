<?php
namespace phMagick\Core;
class Collection
{
    private $items = array();

    public function add($item)
    {
        $this->items[] = $item;
    }

    public function getAll()
    {
        return $this->$items;
    }

    public function get($index)
    {
        return $this->items[intval($key)];
    }
}
