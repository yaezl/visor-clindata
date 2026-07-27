<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionEstudiosInternacion
 * 
 * @property int $id
 * @property int|null $personal_id
 * @property int|null $persona_internacion_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property Carbon $fecha
 * @property string|null $estado_msg
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property string|null $estado
 * @property string|null $url
 * 
 * @property Personal|null $personal
 * @property InternacionPersona|null $internacion_persona
 * @property Usuario|null $usuario
 * @property Collection|BonoEstudiointernacion[] $bono_estudiointernacions
 * @property Collection|InternacionDetalleEstudiosInternacion[] $internacion_detalle_estudios_internacions
 *
 * @package App\Models
 */
class InternacionEstudiosInternacion extends Model
{
	protected $table = 'internacion_estudios_internacion';
	public $timestamps = false;

	protected $casts = [
		'personal_id' => 'int',
		'persona_internacion_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'personal_id',
		'persona_internacion_id',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'fecha',
		'estado_msg',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'estado',
		'url'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}

	public function bono_estudiointernacions()
	{
		return $this->hasMany(BonoEstudiointernacion::class, 'estudiointernacion_id');
	}

	public function internacion_detalle_estudios_internacions()
	{
		return $this->hasMany(InternacionDetalleEstudiosInternacion::class, 'estudiosInternacion_id');
	}
}
