<?php

namespace App\Http\Controllers;

use App\Models\HouseRent;
use App\Models\User;
use Illuminate\Http\Request;

class HouseRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $housesRent = HouseRent::all();

        // dd($housesRent[0]->name);

        return view('rent.list', compact('housesRent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rent.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validateData = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/images/receipt');

        

        $save = new HouseRent;

        $save->bill_image = $name;
        $save->path = $path;
        $save->user_id = auth()->user()->id;
        $save->amount = $request->amount;
        $save->month = $request->month;
        $save->created_by = auth()->user()->name;
        $save->save();

        return back()->withStatus(__('Bill successfully uploaded.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseRent  $houseRent
     * @return \Illuminate\Http\Response
     */
    public function show(HouseRent $houseRent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseRent  $houseRent
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseRent $houseRent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseRent  $houseRent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseRent $houseRent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseRent  $houseRent
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseRent $houseRent)
    {
        //
    }
}
