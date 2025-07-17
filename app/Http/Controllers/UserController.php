<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.user.users', compact('users'));
    }

    public function editUserRole($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.user.edit-user-role', compact('user'));
    }

    public function updateUserRole(Request $request, $user_id)
    {
        $request->validate([
            'role' => 'required|string', // Adjust if roles are numeric
        ]);

        $user = User::findOrFail($user_id);
        $user->role = $request->input('role');
        $user->save();

        // logout if change role to 0
        
        return redirect()->route('admin.user.users')->with('success', 'User role updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.users')->with('success', 'User deleted successfully.');
    }
}
