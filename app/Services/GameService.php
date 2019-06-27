<?php

namespace App\Services;




use App\Game;
use App\Round;
use App\Exceptions\GameFinishedException;

class GameService
{
    public function createGame($players)
    {
        $game = new Game;

        $game->player_one = $players[0];
        $game->player_two = $players[1];

        $game->save();
        $game = Game::with('rounds')->find($game->id);

        return $game;
    }

    public function getGame($id)
    {
        return Game::with('rounds')->findOrFail($id);
    }

    public function playRound($id, $movements)
    {
        $game = Game::with('rounds')->findOrFail($id);

        if ($game->player_winner !== null) {
            throw new GameFinishedException();
        }

        $round = new Round;
        $round->game_id = $game->id;
        $round->player_one_move = $movements[0];
        $round->player_two_move = $movements[1];
        $round->player_winner = $this->getRoundWinner($movements);

        $round->save();

        $game->refresh();
        $game->player_winner = $this->getGameWinner($game->rounds);
        $game->save();

        return $game;
    }

    private function getRoundWinner($movements)
    {
        if ($movements[0] === $movements[1]) return null;

        $rules = [
            'rock' => 'scissors',
            'paper' => 'rock',
            'scissors' => 'paper',
        ];

        return $rules[$movements[0]] === $movements[1] ? 0 : 1;
    }

    private function getGameWinner($rounds)
    {
        $summary = $rounds->reduce(function ($acc, $item) {
            if ($item->player_winner !== null)
                $acc[$item->player_winner] += 1;

            return $acc;
        }, [0, 0]);

        $winner = collect($summary)->search(3);

        return $winner === false ? null : $winner;
    }
}
