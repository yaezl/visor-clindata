<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Turneroasignacion
 * 
 * @property int $id
 * @property int|null $especialidad_id
 * @property int|null $turnero_id
 * @property int|null $asignacion_id
 * @property int|null $agenda_id
 * 
 * @property Especialidad|null $especialidad
 * @property Asignacion|null $asignacion
 * @property Agenda|null $agenda
 * @property Turnero|null $turnero
 *
 * @package App\Models
 */
class Turneroasignacion extends Model
{
	protected $table = 'turneroasignacion';
	public $timestamps = false;

	protected $casts = [
		'especialidad_id' => 'int',
		'turnero_id' => 'int',
		'asignacion_id' => 'int',
		'agenda_id' => 'int'
	];

	protected $fillable = [
		'especialidad_id',
		'turnero_id',
		'asignacion_id',
		'agenda_id'
	];

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function asignacion()
	{
		return $this->belongsTo(Asignacion::class);
	}

	public function agenda()
	{
		return $this->belongsTo(Agenda::class);
	}

	public function turnero()
	{
		return $this->belongsTo(Turnero::class);
	}
}
