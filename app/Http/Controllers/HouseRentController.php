<?php

namespace App\Http\Controllers;

use App\Models\HouseRent;
use App\Models\HouseRentPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $path = $request->file('image')->storeAs('public/images/receipt',$name);

        

        $save = new HouseRent;

        $save->bill_image = $name;
        $save->path = $path;
        $save->user_id = auth()->user()->id;
        $save->amount = $request->amount;
        $save->month = $request->month;
        $save->created_by = auth()->user()->name;
        $save->save();

        $data = HouseRent::select('amount')->latest('id','desc')->first();
        $id = HouseRent::select('id')->latest('id','desc')->first();

        $amount = $data->amount;
        $amount_to_pay = $amount/5;

        // dd($data[0]->amount);

        // $total = ($data[0]->amount)/5;

        // dd($id->id);

        $houseRentPayment = HouseRentPayment::updateOrCreate([
                'user_id' => auth()->user()->id,
                'house_rent_id' => $id->id,
                'amount_to_pay' => $amount_to_pay,
            ]);

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
        $houseRent->id;
        // dd($houseRent->id);
        // $data = DB::table('users')->join('user_details','user_details.user_id',"=",'user_id')
        //         ->join('house_rents','house_rents.user_id',"=",'user_id')
        //         ->get();
        $data = User::join('house_rents','house_rents.user_id',"=",'user_id')
                ->where('house_rents.id',$houseRent->id)
                ->get();

        $data2 = HouseRentPayment::where('house_rent_id',$houseRent->id)->get();

        // $data = HouseRent::find($houseRent)->first();
        // $data = User::all();
        // dd($data2);
        return view('rent.view', ['data' => $data],['data2' => $data2]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseRent  $houseRent
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseRent $houseRent)
    {
        $data = HouseRent::find($houseRent);

        return view('rent.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseRent  $houseRent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        $update = HouseRent::find($request->id);

        $validateData = $request->validate([
            'bill_image' => 'image|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        if ($request->file('bill_image')){
            $bill_image = $request->file('bill_image')->getClientOriginalName();
            $path = $request->file('bill_image')->storeAs('public/images/receipt',$bill_image);
            $update->path = $path;
            $update->bill_image = $bill_image;
        }

        $update->amount = $request->amount;
        $update->month = $request->month;

        $update->update();

        return back()->withStatus(__('Bill updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseRent  $houseRent
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseRent $houseRent)
    {
        $houseRent->delete();

        return back()->withStatus(__('Bill deleted successfully.'));
    }
}
