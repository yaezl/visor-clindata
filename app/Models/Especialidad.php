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
 * Class Especialidad
 * 
 * @property int $id
 * @property int $departamento_id
 * @property int $comportamiento_id
 * @property string $nombre
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property int|null $modified_by
 * @property int $created_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $codigo
 * @property int|null $tipoespecialidad_id
 * @property string|null $codigo_db
 * @property string|null $id_especialidad_pami
 * @property int|null $equipo_id
 * @property string|null $codigo_omint
 * @property string|null $codigo_ad_hoc
 * @property string|null $informacionPortal
 * @property string|null $template_motivo_consulta
 * @property string|null $template_examen_fisico
 * @property bool $es_especial
 * 
 * @property Equipo|null $equipo
 * @property Departamento $departamento
 * @property Comportamiento $comportamiento
 * @property TipoEspecialidad|null $tipo_especialidad
 * @property Collection|Asignacion[] $asignacions
 * @property Collection|Bonocriterio[] $bonocriterios
 * @property Collection|EvolucionDescripcion[] $evolucion_descripcions
 * @property Collection|Facturacriterio[] $facturacriterios
 * @property Collection|InternacionInterconsultum[] $internacion_interconsulta
 * @property Collection|Permiso[] $permisos
 * @property Collection|Personal[] $personals
 * @property Collection|Prefacturacriterio[] $prefacturacriterios
 * @property Collection|ReservaQuirofanoProfesional[] $reserva_quirofano_profesionals
 * @property Collection|Solicitudturno[] $solicitudturnos
 * @property Collection|TopOrdenesEstudio[] $top_ordenes_estudios
 * @property Collection|Turneroasignacion[] $turneroasignacions
 * @property Collection|TurnoGuardium[] $turno_guardia
 *
 * @package App\Models
 */
class Especialidad extends Model
{
	use SoftDeletes;
	protected $table = 'especialidad';

	protected $casts = [
		'departamento_id' => 'int',
		'comportamiento_id' => 'int',
		'modified_by' => 'int',
		'created_by' => 'int',
		'deleted_by' => 'int',
		'tipoespecialidad_id' => 'int',
		'equipo_id' => 'int',
		'es_especial' => 'bool'
	];

	protected $fillable = [
		'departamento_id',
		'comportamiento_id',
		'nombre',
		'modified_by',
		'created_by',
		'deleted_by',
		'codigo',
		'tipoespecialidad_id',
		'codigo_db',
		'id_especialidad_pami',
		'equipo_id',
		'codigo_omint',
		'codigo_ad_hoc',
		'informacionPortal',
		'template_motivo_consulta',
		'template_examen_fisico',
		'es_especial'
	];

	public function equipo()
	{
		return $this->belongsTo(Equipo::class);
	}

	public function departamento()
	{
		return $this->belongsTo(Departamento::class);
	}

	public function comportamiento()
	{
		return $this->belongsTo(Comportamiento::class);
	}

	public function tipo_especialidad()
	{
		return $this->belongsTo(TipoEspecialidad::class, 'tipoespecialidad_id');
	}

	public function asignacions()
	{
		return $this->hasMany(Asignacion::class);
	}

	public function bonocriterios()
	{
		return $this->hasMany(Bonocriterio::class);
	}

	public function evolucion_descripcions()
	{
		return $this->hasMany(EvolucionDescripcion::class);
	}

	public function facturacriterios()
	{
		return $this->hasMany(Facturacriterio::class);
	}

	public function internacion_interconsulta()
	{
		return $this->hasMany(InternacionInterconsultum::class);
	}

	public function permisos()
	{
		return $this->belongsToMany(Permiso::class, 'permisoturno_especialidad')
					->withPivot('id', 'creadopor_id', 'modificadopor_id', 'borradopor_id', 'creado_en', 'modificado_en', 'borrado_en');
	}

	public function personals()
	{
		return $this->belongsToMany(Personal::class, 'personal_especialidad');
	}

	public function prefacturacriterios()
	{
		return $this->hasMany(Prefacturacriterio::class);
	}

	public function reserva_quirofano_profesionals()
	{
		return $this->hasMany(ReservaQuirofanoProfesional::class);
	}

	public function solicitudturnos()
	{
		return $this->hasMany(Solicitudturno::class);
	}

	public function top_ordenes_estudios()
	{
		return $this->hasMany(TopOrdenesEstudio::class);
	}

	public function turneroasignacions()
	{
		return $this->hasMany(Turneroasignacion::class);
	}

	public function turno_guardia()
	{
		return $this->hasMany(TurnoGuardium::class);
	}
}
