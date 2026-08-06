<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonaEmpleado
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $puesto
 * @property string $descr_puesto
 * @property string $departamento
 * @property string $descr_departamento
 * @property string $planta
 * @property string $descr_planta
 * @property string $entidad_legal
 * @property string $descr_entidad
 * @property string $empresa
 * @property string $descr_empresa
 * @property string $division
 * @property string $descr_division
 * @property string $ubicacion
 * @property string $descr_ubicacion
 * @property string $establecimiento
 * @property string $grupo
 * @property string $descr_grupo
 * @property string $tipoEmpleado
 * @property string $descr_tipo_empl
 * @property string $grupoNomina
 * @property string $descr_grupo_nomina
 * @property string $supervisor
 * @property string $turno
 * @property string $descr_turno
 * @property string $reg_patronal
 * @property string $descr_reg_patronal
 * @property bool $es_contratista
 * @property Carbon|null $fecha_ingreso
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Usuario|null $usuario
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class PersonaEmpleado extends Model
{
	protected $table = 'persona_empleado';

	protected $casts = [
		'persona_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'es_contratista' => 'bool',
		'fecha_ingreso' => 'datetime'
	];

	protected $fillable = [
		'persona_id',
		'created_by',
		'modified_by',
		'puesto',
		'descr_puesto',
		'departamento',
		'descr_departamento',
		'planta',
		'descr_planta',
		'entidad_legal',
		'descr_entidad',
		'empresa',
		'descr_empresa',
		'division',
		'descr_division',
		'ubicacion',
		'descr_ubicacion',
		'establecimiento',
		'grupo',
		'descr_grupo',
		'tipoEmpleado',
		'descr_tipo_empl',
		'grupoNomina',
		'descr_grupo_nomina',
		'supervisor',
		'turno',
		'descr_turno',
		'reg_patronal',
		'descr_reg_patronal',
		'es_contratista',
		'fecha_ingreso'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
