<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionEpicrisi
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property int|null $persona_internacion_id
 * @property string|null $motivo_ingreso
 * @property string|null $antecedentes
 * @property string|null $enfermedad_actual
 * @property string|null $evolucion
 * @property string|null $tratamiento_alta
 * @property string|null $plan_alta
 * @property string|null $laboratorio_alta
 * @property string|null $seguimiento
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property string|null $jefe_sala
 * 
 * @property Usuario|null $usuario
 * @property InternacionPersona|null $internacion_persona
 *
 * @package App\Models
 */
class InternacionEpicrisi extends Model
{
	protected $table = 'internacion_epicrisis';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'persona_internacion_id',
		'motivo_ingreso',
		'antecedentes',
		'enfermedad_actual',
		'evolucion',
		'tratamiento_alta',
		'plan_alta',
		'laboratorio_alta',
		'seguimiento',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'jefe_sala'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}
}
