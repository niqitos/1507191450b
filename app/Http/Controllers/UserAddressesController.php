<?php

namespace App\Http\Controllers;

use App\User;
use App\City;
use App\Area;
use App\Address;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    public function store(Request $request, User $user) {
        $this->validate($request, [
            'name'            => 'required',
            'city_id'         => 'required',
            'area_id'         => 'required',
            'street'          => 'required',
            'house'          => 'required',
            'additional_info' => 'required',
        ]);

        Address::create([
            'user_id'         => $user->id,
            'name'            => $request->name,
            'city_id'         => $request->city_id,
            'area_id'         => $request->area_id,
            'street'          => $request->street,
            'house'           => $request->house,
            'additional_info' => $request->additional_info,
        ]);

        return back();
    }

    public function show(User $user) {
        $cities = City::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');

        return view('user.show', compact('cities', 'areas','user'));
    }
}