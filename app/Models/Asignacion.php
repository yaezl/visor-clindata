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
 * Class Asignacion
 * 
 * @property int $id
 * @property int $personal_id
 * @property int $especialidad_id
 * @property int $categoria_id
 * @property string|null $comentario
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property bool $activo
 * @property int|null $institucion_id
 * @property int|null $sobreturnos
 * @property bool $disponible_portal
 * @property string|null $aviso_portal
 * @property int $acumulador
 * @property bool $practicas_bloqueantes
 * @property string|null $codigo_ad_hoc
 * 
 * @property Personal $personal
 * @property Especialidad $especialidad
 * @property Categorium $categorium
 * @property Institucion|null $institucion
 * @property Collection|AdmisionAsignacionauditorium[] $admision_asignacionauditoria
 * @property Collection|Agenda[] $agendas
 * @property Collection|AgendaEstudio[] $agenda_estudios
 * @property Collection|Prestacion[] $prestacions
 * @property Collection|DiasnohabilesAsignacion[] $diasnohabiles_asignacions
 * @property Collection|Turnero[] $turneros
 *
 * @package App\Models
 */
class Asignacion extends Model
{
	use SoftDeletes;
	protected $table = 'asignacion';

	protected $casts = [
		'personal_id' => 'int',
		'especialidad_id' => 'int',
		'categoria_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'activo' => 'bool',
		'institucion_id' => 'int',
		'sobreturnos' => 'int',
		'disponible_portal' => 'bool',
		'acumulador' => 'int',
		'practicas_bloqueantes' => 'bool'
	];

	protected $fillable = [
		'personal_id',
		'especialidad_id',
		'categoria_id',
		'comentario',
		'created_by',
		'modified_by',
		'deleted_by',
		'activo',
		'institucion_id',
		'sobreturnos',
		'disponible_portal',
		'aviso_portal',
		'acumulador',
		'practicas_bloqueantes',
		'codigo_ad_hoc'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function categorium()
	{
		return $this->belongsTo(Categorium::class, 'categoria_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function admision_asignacionauditoria()
	{
		return $this->hasMany(AdmisionAsignacionauditorium::class);
	}

	public function agendas()
	{
		return $this->hasMany(Agenda::class);
	}

	public function agenda_estudios()
	{
		return $this->hasMany(AgendaEstudio::class);
	}

	public function prestacions()
	{
		return $this->belongsToMany(Prestacion::class, 'asignacion_prestaciones');
	}

	public function diasnohabiles_asignacions()
	{
		return $this->hasMany(DiasnohabilesAsignacion::class);
	}

	public function turneros()
	{
		return $this->belongsToMany(Turnero::class, 'turneroasignacion')
					->withPivot('id', 'especialidad_id', 'agenda_id');
	}
}
