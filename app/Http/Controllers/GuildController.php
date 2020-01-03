<?php

namespace App\Http\Controllers;

use App\Guild;
use Illuminate\Http\Request;

class GuildController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guilds = Guild::paginate(5);

        return view('guilds.index',compact('guilds'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guilds.create');
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
        ]);

        Guild::create($request->all());

        return redirect()->route('guilds.index')->with('success','Guild created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function show(Guild $guild)
    {
        return view('guilds.show',compact('guild'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function edit(Guild $guild)
    {
        return view('guilds.edit',compact('guild'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guild $guild)
    {
        $guild->update($request->data);

        return redirect()->route('guilds.index')->with('success','Guild updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Guild  $guild
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guild $guild)
    {
        $guild->delete();

        return redirect()->route('guilds.index')->with('success','Guild deleted successfully');
    }
}
