<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $rolesUser = RoleUser::where('user_id', '=', $user->id)->get();
        $roles = Role::all();

        $rolesRequest = array_intersect($request->all(), $roles->pluck('id')->toArray());

        foreach ($rolesRequest as $roleRequest) {
            if (!$rolesUser->contains('role_id', $roleRequest)) {
                RoleUser::create([
                    'user_id' => $user->id,
                    'role_id' => $roleRequest,
                ]);
            }
        }

        $rolesToDelete = $rolesUser->reject(function ($roleUser) use ($rolesRequest) {
            return in_array($roleUser->role_id, $rolesRequest);
        });

        foreach ($rolesToDelete as $roleUser) {
            $roleUser->delete();
        }

        return redirect()->route('components.configurations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
