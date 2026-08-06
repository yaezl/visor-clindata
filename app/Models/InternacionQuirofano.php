<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionQuirofano
 * 
 * @property int $id
 * @property int|null $reserva_quirofano_id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre
 * @property Carbon $horaInicio
 * @property Carbon $horaFin
 * @property string $frecuencia
 * @property Carbon $updated_at
 * @property bool $ocupado
 * @property bool $borradoLogico
 * @property int $institucion_id
 * 
 * @property Usuario $usuario
 * @property ReservaQuirofano|null $reserva_quirofano
 * @property Institucion $institucion
 * @property Collection|AuditoriaReservaQuirofano[] $auditoria_reserva_quirofanos
 * @property Collection|InternacionQuirofanoAgenda[] $internacion_quirofano_agendas
 * @property Collection|ReservaQuirofano[] $reserva_quirofanos
 *
 * @package App\Models
 */
class InternacionQuirofano extends Model
{
	protected $table = 'internacion_quirofano';
	public $timestamps = false;

	protected $casts = [
		'reserva_quirofano_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'horaInicio' => 'datetime',
		'horaFin' => 'datetime',
		'ocupado' => 'bool',
		'borradoLogico' => 'bool',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'reserva_quirofano_id',
		'created_by',
		'modified_by',
		'nombre',
		'horaInicio',
		'horaFin',
		'frecuencia',
		'ocupado',
		'borradoLogico',
		'institucion_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function auditoria_reserva_quirofanos()
	{
		return $this->hasMany(AuditoriaReservaQuirofano::class, 'quirofano');
	}

	public function internacion_quirofano_agendas()
	{
		return $this->hasMany(InternacionQuirofanoAgenda::class, 'quirofano_id');
	}

	public function reserva_quirofanos()
	{
		return $this->hasMany(ReservaQuirofano::class, 'quirofano');
	}
}
