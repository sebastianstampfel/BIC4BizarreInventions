<?php

namespace App\Http\Controllers;

use App\Invention;
use Illuminate\Http\Request;

class InventionController extends Controller
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
        $invention = Invention::all();

        return view('invention.index', compact('invention'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invention.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invention  $invention
     * @return \Illuminate\Http\Response
     */
    public function show(Invention $invention)
    {
        return view('invention.show', compact('invention'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invention  $invention
     * @return \Illuminate\Http\Response
     */
    public function edit(Invention $invention)
    {
        return view('invention.edit', compact($invention));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invention  $invention
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invention $invention)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invention  $invention
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invention $invention)
    {
        //
    }


    /**
     * Show form for searching.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('invention.search');
    }


    /**
     * Return search result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function query(Request $request)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return Invention::all()->load('domain');
    }
}
