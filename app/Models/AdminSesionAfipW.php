<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminSesionAfipW
 * 
 * @property int $id
 * @property string $service
 * @property string $token
 * @property string $sign
 * @property Carbon $generation_time
 * @property Carbon $expiration_time
 * @property Carbon $created_at
 *
 * @package App\Models
 */
class AdminSesionAfipW extends Model
{
	protected $table = 'admin_sesion_afip_ws';
	public $timestamps = false;

	protected $casts = [
		'generation_time' => 'datetime',
		'expiration_time' => 'datetime'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'service',
		'token',
		'sign',
		'generation_time',
		'expiration_time'
	];
}
