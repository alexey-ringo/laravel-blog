<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function create(User $user) {
        return $user->canDo('CREATE_ARTICLE');
        //foreach($user->roles as $role) {
        //    if($role->name == 'Admin') 
        //        return true; 
        //}
        //return false;
    }
}
