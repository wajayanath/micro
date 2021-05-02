<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\RoleResource;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class RoleController
{
    public function index()
    {
        Gate::authorize('view','roles');

        return RoleResource::collection(Role::all());
    }

    public function store(Request $request)
    {
        Gate::authorize('edit','roles');

        $role = Role::create($request->only('name'));

         if($permission = $request->input('permissions')) {
             foreach ($permission as $permission_id) {
                  DB::table('role_permissions')->insert([
                      'role_id' => $role->id,
                      'permission_id' => $permission_id,
                  ]);
             }
         }

        return response(new RoleResource($role), Response::HTTP_CREATED);
    }

    public function show($id)
    {
        Gate::authorize('view','roles');

        return new RoleResource(Role::find($id));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('edit','roles');

        $role = Role::find($id);

        $role->update($request->only('name'));

        DB::table('role_permissions')->where('role_id', $role->id)->delete();

        if($permission = $request->input('permissions')) {
            foreach ($permission as $permission_id) {
                DB::table('role_permissions')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        return response(new RoleResource($role), Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Gate::authorize('edit','roles');

        DB::table('role_permissions')->where('role_id', $id)->delete();

        Role::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
