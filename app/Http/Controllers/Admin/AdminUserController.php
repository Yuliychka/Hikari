<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $staff = User::whereIn('role', ['super admin', 'admin', 'manager', 'seller', 'delivery'])->get();
        $clients = User::where('role', 'user')->orWhereNull('role')->get();

        return view('admin.users.index', compact('staff', 'clients'));
    }

    public function createStaff()
    {
        return view('admin.users.create_staff');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,manager,seller,delivery',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Staff member created successfully.');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:super admin,admin,manager,seller,delivery,user',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    public function addWarning(User $user)
    {
        $user->increment('warnings');
        return redirect()->back()->with('success', 'Warning added to player.');
    }

    public function removeWarning(User $user)
    {
        if ($user->warnings > 0) {
            $user->decrement('warnings');
        }
        return redirect()->back()->with('success', 'Warning removed from player.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User eliminated from the system.');
    }
}
