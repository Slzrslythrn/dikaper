<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class DataUserController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $user =  User::all();
        return view('pages.admin.data-user', compact('user'));
    }

    public function buat()
    {
        return view('pages.admin.user.buat');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'min:16', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'level' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        Log::logSave('Membuat User Baru ' . $request->name);
        Alert::success('Data Berhasil Dinputkan');
        return redirect()->route('data-user');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'min:16', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'level' => ['required'],
        ]);

        $attr = [
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'level' => $request->level,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ];

        $user->update($attr);

        Log::logSave('Mengedit Data User ' . $request->name);
        Alert::success('Data Berhasil Diedit');
        return redirect()->route('data-user');
    }

    public function verifikasi($user_id)
    {
        $user = User::findOrFail($user_id);
        $attr['email_verified_at'] = now();
        $user->update($attr);

        Log::logSave('Memverifikasi Data User ' . $user->name);
        Alert::success('Data Berhasil Diverifikasi');
        return redirect()->route('data-user');
    }

    public function destroy(User $user)
    {
        Log::logSave('Menghapus User ' . $user->name);

        $user->delete();
        Alert::success('Data Berhasil Dihapus');
        return redirect()->route('data-user');
    }
}
