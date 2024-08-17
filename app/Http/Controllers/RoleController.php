<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('dashboard.hak-akses.index', [
            'roles' => $roles
        ]);
    }

    public function create(){
        $permissions = Permission::all();
        return view('dashboard.hak-akses.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:roles','string', 'max:255'],
            'hak_akses' => ['sometimes', 'nullable'],
        ]);

        try{
            DB::transaction(function() use($validatedData) {
                $role = Role::create([
                    'name' => $validatedData['name']
                ]);
                
                // Memberikan Permission kepada Roles
                if(isset($validatedData['hak_akses'])){
                    $role->givePermissionTo($validatedData['hak_akses']);
                }
                // Notifikasi berhasil
                Alert::success('Peran Pengguna nama: ' . $role->name . ' berhasil ditambahkan', 'success');
            });

            // Redirect ke halaman index
            return redirect()->route('dashboard.hak-akses.index');
        }catch(Exception $e){
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in storing roles data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat menambahkan data peran pengguna. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data peran pengguna.']);
        }
    }

    public function edit(Role $role){
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        return view('dashboard.hak-akses.edit', [
            'role' => $role,
            'role_permission' => $rolePermissions
        ]);
    }

    public function update(Request $request, Role $role){
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($role),'string', 'max:255'],
            'hak_akses' => ['sometimes', 'nullable'],
        ]);

        try{
            DB::transaction(function() use($validatedData, $role) {
                $role->update([
                    'name' => $validatedData['name']
                ]);
                
                // Menghapus Permission sebelumnya pada Role
                $role->revokePermissionTo($role->permissions->pluck('name')->toArray());
                
                // Memberikan Permission baru kepada Role
                if(isset($validatedData['hak_akses'])){
                    $role->givePermissionTo($validatedData['hak_akses']);
                }
                
                // Notifikasi berhasil
                Alert::success('Peran Pengguna nama: ' . $role->name . ' berhasil diedit', 'success');
            });

            // Redirect ke halaman index
            return redirect()->route('dashboard.hak-akses.index');
        }catch(Exception $e){
            // (error handling)
            // Log error dan tampilkan pesan kesalahan ke pengguna
            Log::error('Error in editing roles data: ' . $e->getMessage());

            Alert::error('Terjadi kesalahan saat mengedit peran pengguna. Silakan coba lagi.');

            // Redirect ke halaman sebelumnya atau halaman kesalahan
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mengedit peran pengguna.']);
        }
    }
}
