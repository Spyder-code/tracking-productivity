<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Game::all();
        return view('admin.game.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.game.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $game = Game::create($request->all());

        if ($files = $request->file('image')) {
            $profileImage = $game->id.'.jpg';
            $path = $files->storeAs('public/images/game', $profileImage);
            $url = Storage::url($path);
            $imgUrl = url($url);
            Game::find($game->id)->update(['image'=>$imgUrl]);
            return redirect()->route('game.index')->with('success','Game '.$game->name.' Berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('admin.game.edit',compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required',
            'class' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $game = Game::find($game->id)->update($request->all());

        if ($files = $request->file('image')) {
            $profileImage = $game->id.'.jpg';
            $path = $files->storeAs('public/images/game', $profileImage);
            $url = Storage::url($path);
            $imgUrl = url($url);
            Game::find($game->id)->update(['image'=>$imgUrl]);
        }
        return redirect()->route('game.index')->with('success','Game '.$game->name.' Berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        Game::destroy($game->id);
        return redirect()->route('game.index')->with('success','Game '.$game->name.' Berhasil dihapus!');
    }
}
