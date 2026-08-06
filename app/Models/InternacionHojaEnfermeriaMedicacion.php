<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaMedicacion
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $persona_internacion_id
 * @property int|null $tipo_id
 * @property int|null $atp_id
 * @property string $nota
 * @property Carbon $fecha
 * @property string $hora
 * @property string $hora_manual
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * @property bool $rescate
 * @property bool $unicaDosis
 * @property string $prescripcion
 * 
 * @property Usuario|null $usuario
 * @property InternacionPersona|null $internacion_persona
 * @property InternacionTipoMedicacion|null $internacion_tipo_medicacion
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Collection|Envioapersona[] $envioapersonas
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaMedicacion extends Model
{
	protected $table = 'internacion_hoja_enfermeria_medicacion';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'tipo_id' => 'int',
		'atp_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool',
		'rescate' => 'bool',
		'unicaDosis' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'persona_internacion_id',
		'tipo_id',
		'atp_id',
		'nota',
		'fecha',
		'hora',
		'hora_manual',
		'creado_en',
		'modificado_en',
		'activo',
		'rescate',
		'unicaDosis',
		'prescripcion'
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

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}

	public function envioapersonas()
	{
		return $this->hasMany(Envioapersona::class, 'aplicacionEnfermeria_id');
	}
}
