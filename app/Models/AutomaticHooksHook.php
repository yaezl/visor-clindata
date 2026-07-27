<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutomaticHooksHook
 * 
 * @property int $automatic_hook_id
 * @property int $hook_id
 *
 * @package App\Models
 */
class AutomaticHooksHook extends Model
{
	protected $table = 'automatic_hooks_hooks';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'automatic_hook_id' => 'int',
		'hook_id' => 'int'
	];
}
