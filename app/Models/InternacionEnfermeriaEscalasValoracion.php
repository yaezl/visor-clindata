<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionEnfermeriaEscalasValoracion
 * 
 * @property int $id
 * @property bool $borrado_logico
 * @property string $tipo_escala
 * @property Carbon $fecha_escala
 * @property Carbon $hora_escala
 * @property int $puntaje
 * @property string|null $datos_adicionales
 * @property int $responsable_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property int $persona_internacion_id
 * @property int $creado_por_id
 * @property int|null $modificado_por_id
 * 
 * @property Usuario $usuario
 * @property InternacionPersona $internacion_persona
 *
 * @package App\Models
 */
class InternacionEnfermeriaEscalasValoracion extends Model
{
	protected $table = 'internacion_enfermeria_escalas_valoracion';
	public $timestamps = false;

	protected $casts = [
		'borrado_logico' => 'bool',
		'fecha_escala' => 'datetime',
		'hora_escala' => 'datetime',
		'puntaje' => 'int',
		'responsable_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'persona_internacion_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int'
	];

	protected $fillable = [
		'borrado_logico',
		'tipo_escala',
		'fecha_escala',
		'hora_escala',
		'puntaje',
		'datos_adicionales',
		'responsable_id',
		'creado_en',
		'modificado_en',
		'persona_internacion_id',
		'creado_por_id',
		'modificado_por_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'responsable_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}
}
