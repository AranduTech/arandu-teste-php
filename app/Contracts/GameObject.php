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

    /**
     * Retorna a posição 'X' no tabuleiro
     *
     * @return int
     */
    public function x()
    {
        return $this->_x;
    }

    /**
     * Retorna a posição 'Y' no tabuleiro
     * @return int
     */
    public function y()
    {
        return $this->_y;
    }

    /**
     * Detecta se o objeto está na mesma casa que o objeto passado
     *
     * @param GameObject $object Objeto para detectar a colisão
     * @return bool
     */
    public function isCollidingWith(GameObject $object)
    {
        return $this->_x === $object->_x && $this->_y === $object->_y;
    }

    /**
     * Move o objeto na direção especificada
     *
     * @param string $direction 'ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'
     * @return void
     */
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

    /**
     * Move o objeto para a posição especificada
     *
     * @param int $x
     * @param int $y
     * @return void
     */
    public function moveTo($x, $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    /**
     * Imprime um CSS para adicionar estilo à casa do tabuleiro em que o objeto está.
     *
     * @return void
     */
    abstract function render();
}