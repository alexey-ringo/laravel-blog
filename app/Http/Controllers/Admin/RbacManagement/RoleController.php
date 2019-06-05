<?php

namespace App\Http\Controllers\Admin\RbacManagement;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Возвращает все роли
        return view('admin.rbac_management.role.index', [
            'roles' => Role::paginate(10),
            'permissions' => Permission::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rbac_management.role.create', [
            'role' => [],
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);
        
        $role = Role::create([
            'name' => $request['name']
        ]);
        
        //Проверка на наличие полученного от формы значения поля с name="permissions"
        if($request->input('permissions')) :
            $role->permissions()->attach($request->input('permissions'));
        endif;
        
        return redirect()->route('admin.rbac_management.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.rbac_management.role.edit', [
            'role' => $role,
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $role->name = $request['name'];
        $role->save();
        
        //Если список разрешений операций пуст - отсоединяем
        $role->permissions()->detach();
        //Проверка на наличие полученного от формы значения поля с name="roles"
        if($request->input('permissions')) :
            $role->permissions()->attach($request->input('permissions'));
        endif;
        
        return redirect()->route('admin.rbac_management.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        return redirect()->route('admin.rbac_management.role.index');
    }
}
