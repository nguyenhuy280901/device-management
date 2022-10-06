<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

	protected $fillable = [
        'name', 'slug'
    ];
	public $timestamps = false;

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
		$this->permissions()->saveMany(Permission::whereIn('id', $permissions)->get());

        return $this;
    }
 
	/**
	 * Revoke permissions of a role
	 * 
	 * @param array $permissions
	 * @return \Illuminate\Database\Eloquent\Model
	 */
    public function revokePermissions(array $permissions)
	{
		$this->permissions()->detach(Permission::whereIn('id', $permissions)->get());

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
		$oldPermissions = $this->permissions->pluck('id')->toArray();
		$attachPermissions = array_diff($permissions, $oldPermissions);
		$detachPermissions = array_diff($oldPermissions, $permissions);

		$this->revokePermissions($detachPermissions);
		$this->grantPermissions($attachPermissions);

		return $this;
 	}
}
