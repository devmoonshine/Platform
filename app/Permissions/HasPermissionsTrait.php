<?php 

namespace App\Permissions;

use App\{Role, Permission};

trait HasPermissionsTrait {

	public function givePermissionTo(...$permissions)
	{
		$permissions = $this->getAllPermissions($permissions);

		if ($permissions == null) {
			return $this;
		}
		
		$this->permissions()->saveMany($permissions);

		return $this;
	}

	public function withdrawPermissionTo(...$permissions)
	{
		$permissions = $this->getAllPermissions($permissions);
		$this->permissions()->detach($permissions);

		return $this;
	}

	/**
	 * Refreshes permission pivot table for user
	 * @param  variadic $permissions variadic permissions
	 * @return 	User
	 */
	public function updatePermissions(...$permissions)
	{
		$this->permissions()->detach();

		return $this->givePermissionTo($permissions);
	}

	public function getAllPermissions($permissions)
	{
		return Permission::whereIn('name', $permissions)->get();
	}

	public function hasRole(...$roles)
	{
		foreach ($roles as $role) {
			if ($this->roles->contains('name', $role)) {
				return true;
			}
		}
		return false;
	}

	public function hasPermissionTo($permission)
	{
		// has permission through role
		// 
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
	}

	public function hasPermissionThroughRole($permission)
	{
		foreach ($permission->roles as $role) {
			if($this->roles->contains($role)) {
				return true;
			}
		}

		return false;
	}

	public function hasPermission($permission)
	{
		return (bool) $this->permissions->where('name', $permission->name)->count();
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class, 'users_permissions');
	}
}