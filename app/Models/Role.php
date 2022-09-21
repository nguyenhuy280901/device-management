<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function permissions()
	{
		return $this->belongsToMany(Permission::class,'roles_permissions');
	}

	/**
	 * Grant permissions to a role
	 * 
	 * @param array $permissions
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function grantPermissions(array $permissions): Model
	{
        $permissions = Permission::whereIn('id', $permissions)->get();

        if($permissions != null) {
			$this->permissions()->saveMany($permissions);
        }

        return $this;
    }
 
	/**
	 * Revoke all permissions of a role
	 * 
	 * @return \Illuminate\Database\Eloquent\Model
	 */
    public function revokePermissions()
	{
		$this->permissions()->detach();

		return $this;
 	}

	/**
	 * Refresh permissions of a role
	 * 
	 * @param array $permissions
	 * @return \Illuminate\Database\Eloquent\Model
	 */
    public function refreshPermissions(array $permissions)
	{
		$this->revokePermissions();
		$this->grantPermissions($permissions);

		return $this;
 	}
}
