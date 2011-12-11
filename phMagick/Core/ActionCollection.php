<?php
namespace phMagick\Core;

class ActionCollection
{
    protected $items = array();

    public function add(Action $item)
    {
        $this->items[] = $item;
    }

    public function getAll()
    {
        return $this->items;
    }

    public function get($index)
    {
        return $this->items[intval($index)];
    }
}
