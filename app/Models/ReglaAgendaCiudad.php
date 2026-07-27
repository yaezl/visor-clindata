<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaCiudad
 * 
 * @property int $id
 * @property bool $bloqueante
 * 
 * @property ReglaAgenda $regla_agenda
 * @property Collection|CiudadRegla[] $ciudad_reglas
 *
 * @package App\Models
 */
class ReglaAgendaCiudad extends Model
{
	protected $table = 'regla_agenda_ciudad';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'bloqueante' => 'bool'
	];

	protected $fillable = [
		'bloqueante'
	];

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}

	public function ciudad_reglas()
	{
		return $this->hasMany(CiudadRegla::class, 'regla_agenda_id');
	}
}
