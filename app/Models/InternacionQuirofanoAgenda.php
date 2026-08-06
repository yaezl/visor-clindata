<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofanoAgenda
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $quirofano_id
 * @property Carbon $horaInicio
 * @property Carbon $horaFin
 * @property string $frecuencia
 * @property Carbon $inicioVigencia
 * @property Carbon $finVigencia
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borradoLogico
 * 
 * @property Usuario $usuario
 * @property InternacionQuirofano $internacion_quirofano
 *
 * @package App\Models
 */
class InternacionQuirofanoAgenda extends Model
{
	protected $table = 'internacion_quirofano_agenda';

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'quirofano_id' => 'int',
		'horaInicio' => 'datetime',
		'horaFin' => 'datetime',
		'inicioVigencia' => 'datetime',
		'finVigencia' => 'datetime',
		'borradoLogico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'quirofano_id',
		'horaInicio',
		'horaFin',
		'frecuencia',
		'inicioVigencia',
		'finVigencia',
		'borradoLogico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_quirofano()
	{
		return $this->belongsTo(InternacionQuirofano::class, 'quirofano_id');
	}
}
