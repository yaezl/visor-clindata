<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaIndicacion
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $persona_internacion_id
 * @property int|null $tipo_id
 * @property string $nota
 * @property Carbon $fecha
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property Usuario|null $usuario
 * @property InternacionPersona|null $internacion_persona
 * @property InternacionTipoMedicacion|null $internacion_tipo_medicacion
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaIndicacion extends Model
{
	protected $table = 'internacion_hoja_enfermeria_indicacion';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'tipo_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'persona_internacion_id',
		'tipo_id',
		'nota',
		'fecha',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function internacion_tipo_medicacion()
	{
		return $this->belongsTo(InternacionTipoMedicacion::class, 'tipo_id');
	}
}
