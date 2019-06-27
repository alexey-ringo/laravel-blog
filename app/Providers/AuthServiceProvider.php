<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Article;
use App\Policies\ArticlePolicy;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        //Gate::define('VIEW_ARTICLE', function (User $user) {
        //    return $user->canDo('VIEW_ARTICLE', true);
        //});
        /*
        Gate::define('add-article', function (User $user) {
            foreach($user->roles as $role) {
                if($role->name == 'Admin') {
                    return true;
                }
            }
            return false;
        });
        */

        //
    }
}
