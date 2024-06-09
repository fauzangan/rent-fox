<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $roles = Role::all();
        return view('dashboard.users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function create(){
        $roles = Role::all();
        return view('dashboard.users.create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'min:10','string', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'role' => ['sometimes', 'nullable', 'string'],
        ]);

        try{
            DB::transaction(function() use($validatedData) {
                $user = User::create([
                    'name' => $validatedData['name'],
                    'username' => $validatedData['username'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']), 
                ]);
                
                // Memberikan role kepada pengguna
                if(isset($validatedData['role'])){
                    $user->assignRole($validatedData['role']);
                }

                // Notifikasi berhasil
                Alert::success('Pengguna dengan nama: ' . $user->name . ' berhasil ditambahkan', 'success');
            });

            // Redirect ke halaman index
            return redirect()->route('dashboard.users.index');
        }catch(Exception $e){
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing pengguna data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data pengguna. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data pengguna.']);
        }
    }

    public function edit(User $user){
        $roles = Role::all();
        return view('dashboard.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, User $user){
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', Rule::unique('users')->ignore($user)],
            'email' => ['required', 'string', Rule::unique('users')->ignore($user)],
            'role' => ['sometimes', 'nullable', 'string'],
        ]);

        try{
            DB::transaction(function() use($validatedData, $user) {
                $user->update([
                    'name' => $validatedData['name'],
                    'username' => $validatedData['username'],
                    'email' => $validatedData['email'],
                ]);
                
                // Memberikan role kepada pengguna
                if(isset($validatedData['role'])){
                    $user->syncRoles($validatedData['role']);
                }else{
                    $user->removeRole($user->roles->pluck('name')->toArray()[0]);
                }

                // Notifikasi berhasil
                Alert::success('Pengguna dengan nama: ' . $user->name . ' berhasil diedit', 'success');
            });

            // Redirect ke halaman index
            return redirect()->route('dashboard.users.index');
        }catch(Exception $e){
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing pengguna data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit data pengguna. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit data pengguna.']);
        }
    }

    public function editPassword(User $user){
        return view('dashboard.users.reset-password', [
            'user' => $user
        ]);
    }

    public function updatePassword(Request $request, User $user){
        $validatedData = $request->validate([
            'password' => ['required', 'min:10','string', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ]);

        try{
            DB::transaction(function() use($validatedData, $user) {
                $user->update([
                    'password' => Hash::make($validatedData['password']), 
                ]);
                
                // Notifikasi berhasil
                Alert::success('Password : ' . $user->name . ' berhasil direset', 'success');
            });

            // Redirect ke halaman index
            return redirect()->route('dashboard.users.index');
        }catch(Exception $e){
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in reseting password pengguna data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat reset password pengguna. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat reset password pengguna.']);
        }
    }
}
