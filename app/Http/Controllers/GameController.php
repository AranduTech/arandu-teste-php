<?php

namespace App\Http\Controllers;

use App\Constants\Map;
use App\Models\Enemy;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GameController extends Controller
{

    public $score = 0;

    /** @var Player */
    public $player;

    /** @var Collection<Enemy> */
    public $enemies;

    /**
     * Carrega as instâncias necessárias da sessão ou cria as
     * instâncias dos objetos de jogo caso a sessão esteja vazia.
     *
     * @return void
     */
    public function load()
    {

        $this->player = session(
            'player',
            new Player(
                (1 + (Map::WIDTH - 1)) / 2,
                (1 + (Map::HEIGHT - 1)) / 2
            )
        );

        $this->enemies = session(
            'enemies',
            collect(Enemy::generateEnemies(Map::ENEMIES))
        );

        // $this->writeToSection();
    }

    /**
     * Escreve os objetos de jogo na sessão
     *
     * @return void
     */
    public function writeToSession()
    {
        session([
            'player' => $this->player,
            'enemies' => $this->enemies,
        ]);
    }

    /**
     * Recebe a requisição de movimento do usuário, recalcula
     * os posicionamentos e atualiza a sessão.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $this->load();

        $this->player->move($request->key);

        $this->enemies->each(function ($enemy) {
            $enemy->moveRandomDirection();
        });

        $this->writeToSession();
    }

    public function scene()
    {
        $this->load();
        $this->writeToSession();

        return view('game');
    }

}