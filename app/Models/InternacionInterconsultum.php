<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionInterconsultum
 * 
 * @property int $id
 * @property int $persona_internacion_id
 * @property int|null $medico_solicitado_id
 * @property int $creadopor_id
 * @property int $modificadopor_id
 * @property int $especialidad_id
 * @property int $profesional_solicitante_id
 * @property string $tipoInterconsulta
 * @property string|null $descripcionSolicitud
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Especialidad $especialidad
 * @property Usuario $usuario
 * @property Personal|null $personal
 * @property InternacionPersona $internacion_persona
 * @property Collection|InternacionInterconsultaComentario[] $internacion_interconsulta_comentarios
 *
 * @package App\Models
 */
class InternacionInterconsultum extends Model
{
	protected $table = 'internacion_interconsulta';

	protected $casts = [
		'persona_internacion_id' => 'int',
		'medico_solicitado_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'especialidad_id' => 'int',
		'profesional_solicitante_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'persona_internacion_id',
		'medico_solicitado_id',
		'creadopor_id',
		'modificadopor_id',
		'especialidad_id',
		'profesional_solicitante_id',
		'tipoInterconsulta',
		'descripcionSolicitud',
		'borrado_logico'
	];

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'medico_solicitado_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function internacion_interconsulta_comentarios()
	{
		return $this->hasMany(InternacionInterconsultaComentario::class, 'interconsulta_id');
	}
}
