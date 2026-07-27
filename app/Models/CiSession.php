<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CiSession
 * 
 * @property string|null $user_agent
 * @property string|null $ip_address
 * @property int|null $last_activity
 * @property string $data
 * @property string $id
 * @property int $timestamp
 *
 * @package App\Models
 */
class CiSession extends Model
{
	protected $table = 'ci_sessions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'last_activity' => 'int',
		'timestamp' => 'int'
	];

	protected $fillable = [
		'user_agent',
		'ip_address',
		'last_activity',
		'data',
		'timestamp'
	];
}
