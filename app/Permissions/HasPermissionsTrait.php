<?php
namespace App\Permissions;

use App\Permission;
use App\Role;

trait HasPermissionsTrait {

   public function roles() {
      return $this->belongsToMany(Role::class,'role_user');

   }


   //public function permissions() {
//      return $this->belongsToMany(Permission::class,'users_permissions');
//
//   }


}