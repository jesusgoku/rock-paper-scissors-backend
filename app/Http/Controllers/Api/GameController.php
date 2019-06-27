<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;

use App\Game;
use App\Round;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGamePost;
use App\Http\Requests\UpdateGamePost;
use App\Services\GameService;
use App\Exceptions\GameFinishedException;
use Mockery\CountValidator\Exception;

class GameController extends Controller
{
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function store(StoreGamePost $request)
    {
        $players = $request->input('players');

        $game = $this->gameService->createGame($players);

        return response()->json($game, Response::HTTP_CREATED);
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $game = $this->gameService->getGame($id);

        return response()->json($game);
    }

    public function update(UpdateGamePost $request, $id)
    {
        $movements = $request->input('movements');

        try {
            $game = $this->gameService->playRound($id, $movements);

            return response()->json($game);
        } catch (\Exception $e) {
            if ($e instanceof GameFinishedException) {
                return response()
                    ->json(['message' => 'Game is terminated'], Response::HTTP_FORBIDDEN);
            }

            throw $e;
        }
    }
}
