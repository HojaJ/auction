<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UpdateProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('updated_at')
            ->paginate(5);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $photo = null;
        if (!empty($request->photo)) {
            $photo = $request->photo->store('avatars', 'public');
        }
        User::create([
            'name' => $request->name,
           'username'=>$request->username,
           'email'=>$request->email,
           'password'=> bcrypt($request->password),
            'balance' => $request->balance,
            'photo' => $photo
        ]);
        return redirect()->route('admin.users.index')->with('success', __(__('User is created')));
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (isset($request->delete_photo)) {
            Storage::disk('local')->delete('public/' . $user->photo);
            $user->photo = null;
        }

        if (!empty($request->photo)) {
            Storage::disk('local')->delete('public/' . $user->photo);
            $user->photo = $request->photo->store('avatars', 'public');
        }

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', __('User is updated'));
    }

    public function destroy(Request $request, User $user)
    {
        if(!empty($user->photo)){
            Storage::disk('local')->delete('public/' . $user->photo);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', __('User is deleted'));
    }
}
