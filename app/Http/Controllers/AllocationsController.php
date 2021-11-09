<?php

namespace App\Http\Controllers;

use App\Models\Allocations;
use Illuminate\Http\Request;

class AllocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allocations = Allocations::all();
        return $allocations;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allocations = Allocations::create($request->all());
        return $allocations;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Allocations  $allocations
     * @return \Illuminate\Http\Response
     */
    public function show(Allocations $allocations)
    {
        return $allocations;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Allocations  $allocations
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Allocations $allocations)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Allocations  $allocations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Allocations $allocations)
    {
        $allocations->update($request->all());
        return $allocations;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Allocations  $allocations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Allocations $allocations)
    {
        $allocations->delete();
        return ['msg'=> 'User foi deletada com sucesso'];
    }
}
