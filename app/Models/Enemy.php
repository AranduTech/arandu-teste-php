<?php

namespace App\Models;

use App\Constants\Map;
use App\Contracts\GameObject;

class Enemy extends GameObject
{

    static function generateEnemies($count)
    {
        $enemies = [];

        for ($i = 0; $i < $count; $i++) {
            $enemies[] = new Enemy();
        }

        return $enemies;
    }

    public function createRandomPosition()
    {
        return [
            'x' => rand(0, Map::WIDTH - 1),
            'y' => rand(0, Map::HEIGHT - 1)
        ];
    }

    public function __construct()
    {

        [
            'x' => $x,
            'y' => $y
        ] = $this->createRandomPosition();

        # não carregar inimigos no mesmo ponto que o jogador
        while ($this->isCollidingWith(request()->route()->controller->player)) {

            [
                'x' => $x,
                'y' => $y
            ] = $this->createRandomPosition();
        }

        parent::__construct($x, $y);
    }

    public function render()
    {

        $css = "
        .tile-{$this->x()}-{$this->y()} {
            background-color: blue;
        }
        ";

        echo $css;

    }

    /**
     * Mover o inimigo
     *
     * @return void
     */
    public function moveRandomDirection()
    {
        $directions = collect(['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'idle']);

        $direction = $directions->random();

        $this->move($direction);
    }
}