<?php namespace Nova\Users\Http\Controllers;

use Controller;
use Nova\Users\User;
use Illuminate\Contracts\Hashing\Hasher;

class ProfilesController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth');
	}

	public function show(User $user)
	{
		$this->authorize('view', $user);

		return view('pages.users.profile', compact('user'));
	}

	public function edit(User $user)
	{
		$this->authorize('updateProfile', $user);

		return view('pages.users.update-profile', compact('user'));
	}

	public function update(User $user)
	{
		$this->authorize('updateProfile', $user);

		$this->validate(request(), [
			'name' => 'required',
			'email' => 'required|email'
		], [
			'name.required' => _m('user-validation-name'),
			'email.required' => _m('user-validation-email-required'),
			'email.email' => _m('user-validation-email-email')
		]);

		updater(User::class)->with(request()->all())->update($user);

		flash()
			->title(_m('user-flash-updated-title'))
			->message(_m('user-flash-updated-message'))
			->success();

		return back();
	}

	public function updatePassword(Hasher $hasher, User $user)
	{
		$this->authorize('updateProfile', $user);

		if (! $hasher->check(request('password_current'), $user->getPassword())) {
			flash()->message(_m('user-profile-validation-current-password'))->error();

			return back();
		}

		$this->validate(request(), [
			'password_current' => 'required',
			'password_new' => 'required|confirmed|min:6'
		], [
			'password_current.required' => _m('user-validation-password-required'),
			'password_new.required' => _m('user-validation-password-required'),
			'password_new.confirmed' => _m('user-validation-password-confirmed'),
			'password_new.min' => _m('user-validation-password-min'),
		]);

		updater(User::class)
			->with(['password' => request('password_new')])
			->update($user);

		flash()
			->title(_m('user-profile-flash-password-update-title'))
			->message(_m('user-profile-flash-password-update-message'))
			->success();

		return redirect()->route('profile.show', $user);
	}
}
