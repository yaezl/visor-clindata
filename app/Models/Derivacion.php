<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Derivacion
 * 
 * @property int $id
 * @property int|null $institucion_id
 * @property int|null $personal_id
 * @property int|null $internacion_id
 * @property int|null $turno_programado_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * @property int|null $profesional_derivante_id
 * 
 * @property ProfesionalDerivante|null $profesional_derivante
 * @property Usuario|null $usuario
 * @property TurnoProgramado|null $turno_programado
 * @property Personal|null $personal
 * @property Institucion|null $institucion
 * @property InternacionOrden|null $internacion_orden
 *
 * @package App\Models
 */
class Derivacion extends Model
{
	protected $table = 'derivacion';
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'personal_id' => 'int',
		'internacion_id' => 'int',
		'turno_programado_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'profesional_derivante_id' => 'int'
	];

	protected $fillable = [
		'institucion_id',
		'personal_id',
		'internacion_id',
		'turno_programado_id',
		'created_by',
		'modified_by',
		'modified_at',
		'borrado_logico',
		'profesional_derivante_id'
	];

	public function profesional_derivante()
	{
		return $this->belongsTo(ProfesionalDerivante::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function turno_programado()
	{
		return $this->belongsTo(TurnoProgramado::class);
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function internacion_orden()
	{
		return $this->belongsTo(InternacionOrden::class, 'internacion_id');
	}
}
