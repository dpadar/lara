<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return response()->json(User::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
			'firstname' => 'required|string|min:2|max:64',
			'lastname' => 'required|string|min:2|max:64',
			'username' => 'required|string|min:2|max:64',
			'country' => 'required|string|size:2',
			'password' => 'required|string|min:8|max:256',
		]);

		$user = new User;
		
		$user->firstname = $validated['firstname'];
		$user->lastname = $validated['lastname'];
		$user->username = $validated['username'];
		$user->country_code = $validated['country'];
		$user->password = Hash::make($validated['password']);
		$user->admin = false;

		$user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		return response()->json(User::where('id',$id)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
