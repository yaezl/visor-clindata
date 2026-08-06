<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AgendaEstudio
 * 
 * @property int $id
 * @property int|null $asignacion_id
 * @property int|null $estudio_id
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $borrado_logico
 * @property bool $por_defecto
 * @property bool|null $requiere_orden
 * @property bool|null $disponible_portal
 * 
 * @property Asignacion|null $asignacion
 * @property Estudio|null $estudio
 *
 * @package App\Models
 */
class AgendaEstudio extends Model
{
	use SoftDeletes;
	protected $table = 'agenda_estudio';

	protected $casts = [
		'asignacion_id' => 'int',
		'estudio_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'borrado_logico' => 'bool',
		'por_defecto' => 'bool',
		'requiere_orden' => 'bool',
		'disponible_portal' => 'bool'
	];

	protected $fillable = [
		'asignacion_id',
		'estudio_id',
		'created_by',
		'modified_by',
		'deleted_by',
		'borrado_logico',
		'por_defecto',
		'requiere_orden',
		'disponible_portal'
	];

	public function asignacion()
	{
		return $this->belongsTo(Asignacion::class);
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}
}
