<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Storage;
use File;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
	public function postSignUp(Request $request) {
		$this->validate($request, [
			'email' => 'required|email|unique:users',
			'name' => 'required|max:120',
			'password' => 'required|min:4'
		]);

		$email = $request['email'];
		$name = $request['name'];
		$password = bcrypt($request['password']);

		$user = new user();
		$user->email = $email;
		$user->name = $name;
		$user->password = $password;
		$user->save();

		Auth::login($user);

		return redirect()->route('dashboard');
	}

	public function postSignIn(Request $request) {
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required'
		]);

		if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
			return redirect()->route('dashboard');
		}
		return redirect()->back();
	}

	public function getLogout() {
		Auth::logout();
		return redirect()->route('home');
	}

	public function getAccount() {
		return view('account', ['user' => Auth::user()]);
	}

	public function postSaveAccount(Request $request) {
		$this->validate($request, [
				'name' => 'required|max:120'
			]);
		$user = Auth::user();
		$user->name = $request['name'];
		$user->update();
		$file = $request->file('image');
		$filename = $request['name'] . '-' . $user->id . '.jpg';
		if($file) {
			Storage::disk('local')->put($filename, File::get($file));
		}

		return redirect()->route('account');
	}

	public function getUserImage($filename) {
		$file = Storage::disk('local')->get($filename);
		return new Response($file, 200);
	}
}
