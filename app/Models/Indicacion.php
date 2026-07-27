<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Indicacion
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $consulta_id
 * @property bool $externo
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property string $dtype
 * @property string|null $observacionGeneral
 * @property int|null $persona_internacion_id
 * 
 * @property Usuario|null $usuario
 * @property InternacionPersona|null $internacion_persona
 * @property Consultum|null $consultum
 * @property ConsultaRecetaElectronica|null $consulta_receta_electronica
 * @property Hcrecetum|null $hcrecetum
 * @property OrdenAdHoc|null $orden_ad_hoc
 * @property Ordendeestudio|null $ordendeestudio
 * @property Ordendeoftalmologium|null $ordendeoftalmologium
 *
 * @package App\Models
 */
class Indicacion extends Model
{
	protected $table = 'indicacion';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int',
		'consulta_id' => 'int',
		'externo' => 'bool',
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime',
		'persona_internacion_id' => 'int'
	];

	protected $fillable = [
		'created_by',
		'updated_by',
		'consulta_id',
		'externo',
		'borrado_logico',
		'modified_at',
		'dtype',
		'observacionGeneral',
		'persona_internacion_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}

	public function consulta_receta_electronica()
	{
		return $this->hasOne(ConsultaRecetaElectronica::class, 'id');
	}

	public function hcrecetum()
	{
		return $this->hasOne(Hcrecetum::class, 'id');
	}

	public function orden_ad_hoc()
	{
		return $this->hasOne(OrdenAdHoc::class, 'id');
	}

	public function ordendeestudio()
	{
		return $this->hasOne(Ordendeestudio::class, 'id');
	}

	public function ordendeoftalmologium()
	{
		return $this->hasOne(Ordendeoftalmologium::class, 'id');
	}
}
