<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use Illuminate\Http\Request;

class ClotheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function clothesView()
    {
        $clothes = Clothe::all();
        return view('Customer.ClothView', compact('clothes'), ['showHeroSection' => false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Clothe $clothe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clothe $clothe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clothe $clothe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clothe $clothe)
    {
        //
    }
}
