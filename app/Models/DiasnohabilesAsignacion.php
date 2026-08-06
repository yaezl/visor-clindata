<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DiasnohabilesAsignacion
 * 
 * @property int $diasnohabiles_id
 * @property int $asignacion_id
 * 
 * @property DiasNoHabile $dias_no_habile
 * @property Asignacion $asignacion
 *
 * @package App\Models
 */
class DiasnohabilesAsignacion extends Model
{
	protected $table = 'diasnohabiles_asignacion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'diasnohabiles_id' => 'int',
		'asignacion_id' => 'int'
	];

	public function dias_no_habile()
	{
		return $this->belongsTo(DiasNoHabile::class, 'diasnohabiles_id');
	}

	public function asignacion()
	{
		return $this->belongsTo(Asignacion::class);
	}
}
