<?php

namespace App\Http\Controllers;

use App\Models\HandMadeProduct;
use Illuminate\Http\Request;

class HandMadeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function handmadeView()
    {
        $handmadeProducts = HandmadeProduct::all();
        return view('Customer.HandmadeProductView', compact('handmadeProducts'), ['showHeroSection' => false]);
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
    public function show(HandMadeProduct $handMadeProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HandMadeProduct $handMadeProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HandMadeProduct $handMadeProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HandMadeProduct $handMadeProduct)
    {
        //
    }
}
