<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EstadoTurno
 * 
 * @property int $id
 * @property string $nombre
 * @property bool $activo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property int $created_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string $codigo
 * @property int $orden
 * @property bool $borrado_logico
 * @property string $alias
 * @property string|null $color
 * 
 * @property Collection|CambioEstadoTurno[] $cambio_estado_turnos
 * @property Collection|TurnoGuardium[] $turno_guardia
 * @property Collection|TurnoProgramado[] $turno_programados
 * @property Collection|TurnosSugerencium[] $turnos_sugerencia
 *
 * @package App\Models
 */
class EstadoTurno extends Model
{
	use SoftDeletes;
	protected $table = 'estado_turno';

	protected $casts = [
		'activo' => 'bool',
		'modified_by' => 'int',
		'created_by' => 'int',
		'deleted_by' => 'int',
		'orden' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'activo',
		'modified_by',
		'created_by',
		'deleted_by',
		'codigo',
		'orden',
		'borrado_logico',
		'alias',
		'color'
	];

	public function cambio_estado_turnos()
	{
		return $this->hasMany(CambioEstadoTurno::class);
	}

	public function turno_guardia()
	{
		return $this->hasMany(TurnoGuardium::class);
	}

	public function turno_programados()
	{
		return $this->hasMany(TurnoProgramado::class);
	}

	public function turnos_sugerencia()
	{
		return $this->hasMany(TurnosSugerencium::class);
	}
}
