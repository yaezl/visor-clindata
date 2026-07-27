<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VideoRoom
 * 
 * @property int $id
 * @property string|null $codigo
 * @property string|null $password
 * @property string $url
 * @property Carbon|null $expiracion
 * @property Carbon $created_at
 * 
 * @property TurnoProgramado|null $turno_programado
 *
 * @package App\Models
 */
class VideoRoom extends Model
{
	protected $table = 'video_room';
	public $timestamps = false;

	protected $casts = [
		'expiracion' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'codigo',
		'password',
		'url',
		'expiracion'
	];

	public function turno_programado()
	{
		return $this->hasOne(TurnoProgramado::class, 'videoConsulta_id');
	}
}
