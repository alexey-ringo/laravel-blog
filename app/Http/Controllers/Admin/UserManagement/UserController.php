<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Возвращает всех пользователей
        return view('admin.user_management.user.index', [
            'users' => User::paginate(10),
            'roles' => Role::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_management.user.create', [
            'user' => [],
            'roles' => Role::all()
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);
        
        //Проверка на наличие полученного от формы значения поля с name="roles"
        if($request->input('roles')) :
            $user->roles()->attach($request->input('roles'));
        endif;
        
        return redirect()->route('admin.user_management.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user_management.user.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            //Игнор валидации на уникальность для данной операции и для данного пользователя
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                //'users' - таблица
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
            ],
            //пароль при редактировании можем не менять
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        
        $user->name = $request['name'];
        $user->email = $request['email'];
        //Если поле == null - в модель пароль не передавать, иначе - зашифровать перед передачей в модель
        $request['password'] == null ?: $user->password = bcrypt($request['password']);
        $user->save();
        
        //Если список ролей пуст - отсоединяем
        $user->roles()->detach();
        //Проверка на наличие полученного от формы значения поля с name="roles"
        if($request->input('roles')) :
            $user->roles()->attach($request->input('roles'));
        endif;
        
        return redirect()->route('admin.user_management.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $article->roles()->detach();
        $user->delete();
        return redirect()->route('admin.user_management.user.index');
    }
}
