<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;
use App\User;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];
    
    public function permissions() {
        return $this->belongsToMany(Permission::class,'permission_role');
    }
    
    public function users() {
        return $this->belongsToMany(User::class,'role_user');
    }
}
