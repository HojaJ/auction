<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        return redirect()->route('admin.users.index')->with('success', 'User is update.');
    }
}
