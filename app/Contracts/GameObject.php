<?php

namespace App\Contracts;

abstract class GameObject
{
    private $_x;
    private $_y;


    public function __construct(int $x, int $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    public function x()
    {
        return $this->_x;
    }

    public function y()
    {
        return $this->_y;
    }

    public function isCollidingWith(GameObject $object)
    {
        return $this->_x === $object->_x && $this->_y === $object->_y;
    }

    public function move($direction)
    {
        switch ($direction) {
            case 'ArrowUp':
                $this->_y--;
                break;

            case 'ArrowDown':
                $this->_y++;
                break;

            case 'ArrowLeft':
                $this->_x--;
                break;

            case 'ArrowRight':
                $this->_x++;
                break;

            default:
                # code...
                break;
        }
    }

    abstract function render();
}