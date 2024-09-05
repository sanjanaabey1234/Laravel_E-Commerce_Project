<?php

namespace App\Http\Controllers;

use App\Models\Vegitable;
use Illuminate\Http\Request;

class VegitableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function vegetablesView()
    {
        $vegetables = Vegitable::all();
        return view('Customer.Vegetables', compact('vegetables'), ['showHeroSection' => false]);
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
    public function show(Vegitable $vegitable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vegitable $vegitable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vegitable $vegitable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vegitable $vegitable)
    {
        //
    }
}
