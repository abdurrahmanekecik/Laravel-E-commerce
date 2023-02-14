<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)

    {
        $addrs = $user->addrs;
        return view('backend.address.index' , compact('addrs', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    { $addrs = $user->addrs;
        return view('backend.address.create', compact('addrs', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {

        $addr = new Address();

        $addr->user_id = $request->user_id;
        $addr->city = $request->city;
        $addr->district	 = $request->district;
        $addr->zipcode = $request->zipcode;
        $addr->address = $request->address;
        $addr->is_default = $request->is_default ?? 1;
        $addr->save();
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Address $address)
    {
        return view("backend.address.edit", ["user"=>$user, "addr"=>$address] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Address $address, Request $request)
    {
        $addr = Address::find($address->id);
        $addr->user_id = $request->user_id;
        $addr->city = $request->city;
        $addr->district	 = $request->district;
        $addr->zipcode = $request->zipcode;
        $addr->address = $request->address;
        $addr->is_default = $request->is_default ?? 1;
        $addr->save();
        return redirect('/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Address $address)
    {
        $address= Address::find($address->id);
        $address->delete();
        return redirect('/users');

    }
}
