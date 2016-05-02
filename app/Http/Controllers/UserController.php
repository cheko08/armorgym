<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function cambiarPassword()
	{
		return view('user.cambiar-password');
	}

	public function changePassword(ChangePasswordRequest $request, $id)
	{
		$user         = User::FindOrFail($id);
		$oldPassword  = $request->input('old_password');
		$newPassword  = $request->input('new_password');


		if(Hash::check($oldPassword, $user->password))
		{
			$user->password =bcrypt($newPassword);
			$user->save();

			return redirect('user/cambiar-password')->with('global', 'La contraseña ha sido actualizada');;
		}

		return  response('Unauthorized.', 401);
	}

	public function register()
	{
		return view('auth.register');
	}

	public function inactive()
	{
		$users = User::all();
		foreach($users as $user)
		{
			
		}
	}

}
