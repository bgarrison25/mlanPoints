<?php

namespace App\Http\Controllers;

use Auth;
use App\Guild;
use App\Exports\GuildExport;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class GuildController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->authorizeResource(Guild::class, 'guild');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('type') && request()->type === "csv") {
            return Excel::download(new GuildExport, 'guilds.csv');
        }
        $guilds = Guild::orderBy('name')->paginate(10);

        return view('guilds.index',compact('guilds'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
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
        $originalPoints = $guild->points;
        $guild->update([
            'name' => isset($request->data['name']) ? $request->data['name'] : $guild->name,
            'points' => isset($request->data['points']) ? $request->data['points'] : $guild->points,
        ]);

        if ($request->data['points'] != $originalPoints) {
            $guild->pointLogs()->create([
                'user_id' => Auth::user()->id,
                'guild_id' => $guild->id,
                'amount' => $guild->points - $originalPoints,
                'reason' => $request->data['reason'],
            ]);
            dd($guild);
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success'
            ]);
        }

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
