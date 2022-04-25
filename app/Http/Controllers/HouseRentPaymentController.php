<?php

namespace App\Http\Controllers;

use App\Models\HouseRent;
use App\Models\HouseRentPayment;
use Illuminate\Http\Request;

class HouseRentPaymentController extends Controller
{
    public function index()
    {
        $data = HouseRent::select('amount')
            ->where('id',1)->get();

        $total = ($data[0]->amount)/5;

        // $houseRentPayment = HouseRentPayment::updateOrCreate([
        //     'user_id' => auth()->user()->id,
        //     'house_rent_id' => 1,
        //     'amount_to_pay' => $total,
        // ]);

        // auth()->user()->update($houseRentPayment->all());

        // dd($data[0]->amount);
        return view('test', compact('total'));
    }
}
