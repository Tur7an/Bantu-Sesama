<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Alert;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showProfile(){
        $user = User::findOrFail(Auth::id());
        return view('admin.user.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'old_password' => 'nullable|string',
            'password' => 'nullable|required_with:old_password|string|confirmed|min:6'
        ];

        $request->validate($rules);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->filled('old_password')){
            if(Hash::check($request->old_password, $user->password)){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Tolong Periksa Passwordnya Lagi!')])
                    ->withInput();
            }
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(storage_path('app/public/fotos/'.$user->foto))) {
                Storage::delete('app/public/fotos/'.$user->foto);
            }

            $file = $request->file('foto');
            $fileName = 'profil-'.uniqid().$file->getClientOriginalName();
            $request->foto->move(storage_path('app/public/fotos/'), $fileName);
            $user->foto = $fileName;
        }

        $user->save();
        return back()->with('status', 'Profil Terubah');
    }

}
