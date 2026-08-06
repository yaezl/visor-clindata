<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReglaAgendaPrimeraVez
 * 
 * @property int $id
 * @property bool $primera_vez_personal
 * @property bool $primera_vez_especialidad
 * 
 * @property ReglaAgenda $regla_agenda
 *
 * @package App\Models
 */
class ReglaAgendaPrimeraVez extends Model
{
	protected $table = 'regla_agenda_primera_vez';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'primera_vez_personal' => 'bool',
		'primera_vez_especialidad' => 'bool'
	];

	protected $fillable = [
		'primera_vez_personal',
		'primera_vez_especialidad'
	];

	public function regla_agenda()
	{
		return $this->belongsTo(ReglaAgenda::class, 'id');
	}
}
