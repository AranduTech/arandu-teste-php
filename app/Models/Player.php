<?php

namespace App\Models;

use App\Contracts\GameObject;

class Player extends GameObject
{


    public function render()
    {
        $css = "
        .tile-{$this->x()}-{$this->y()} {
            background-color: red;
        }
        ";

        echo $css;
    }
}