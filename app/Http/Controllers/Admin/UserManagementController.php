<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function store(Request $request)
    {
      $profileName = null;

      if ($request->hasFile('profile')) {
        $file = $request->file('profile');
        $profileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('profiles'), $profileName);
      }

      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'profile' => $profileName,
      ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
      $user = User::findOrFail($id);

      $profileName = $user->profile;

      if ($request->hasFile('profile')) {
        $file = $request->file('profile');
        $profileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('profiles'), $profileName);
      }

      $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'role' => $request->role,
        'profile' => $profileName,
      ]);

        return redirect()->back()->with('success', 'User updated successfully.');
    }
}
