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
 * Class Consultum
 * 
 * @property int $id
 * @property int|null $turno_id
 * @property int|null $tipoegreso_id
 * @property Carbon $fechahorainicio
 * @property Carbon|null $fechahorafin
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon|null $updated_at
 * @property int|null $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int $personal_id
 * @property int|null $evento_id
 * @property int|null $direccion_id
 * @property int|null $acumulador
 * 
 * @property TurnoProgramado|null $turno_programado
 * @property ConsultaTipoEgreso|null $consulta_tipo_egreso
 * @property Personal $personal
 * @property Eventohc|null $eventohc
 * @property Direccion|null $direccion
 * @property Collection|Articuloprescripto[] $articuloprescriptos
 * @property Collection|Auditoriadiagnostico[] $auditoriadiagnosticos
 * @property Collection|Consultadetalle[] $consultadetalles
 * @property Collection|Consumo[] $consumos
 * @property Collection|Estudiocomplementario[] $estudiocomplementarios
 * @property Collection|HcAplicacionVacunaHc[] $hc_aplicacion_vacuna_hcs
 * @property Collection|HcPerinatalHc[] $hc_perinatal_hcs
 * @property Collection|Indicacion[] $indicacions
 * @property Collection|ServicioPaciente[] $servicio_pacientes
 *
 * @package App\Models
 */
class Consultum extends Model
{
	use SoftDeletes;
	protected $table = 'consulta';

	protected $casts = [
		'turno_id' => 'int',
		'tipoegreso_id' => 'int',
		'fechahorainicio' => 'datetime',
		'fechahorafin' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'personal_id' => 'int',
		'evento_id' => 'int',
		'direccion_id' => 'int',
		'acumulador' => 'int'
	];

	protected $fillable = [
		'turno_id',
		'tipoegreso_id',
		'fechahorainicio',
		'fechahorafin',
		'created_by',
		'modified_by',
		'deleted_by',
		'personal_id',
		'evento_id',
		'direccion_id',
		'acumulador'
	];

	public function turno_programado()
	{
		return $this->hasOne(TurnoProgramado::class, 'consulta_id');
	}

	public function consulta_tipo_egreso()
	{
		return $this->belongsTo(ConsultaTipoEgreso::class, 'tipoegreso_id');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function eventohc()
	{
		return $this->belongsTo(Eventohc::class, 'evento_id');
	}

	public function direccion()
	{
		return $this->belongsTo(Direccion::class);
	}

	public function articuloprescriptos()
	{
		return $this->hasMany(Articuloprescripto::class, 'consulta_id');
	}

	public function auditoriadiagnosticos()
	{
		return $this->hasMany(Auditoriadiagnostico::class, 'consulta_id');
	}

	public function consultadetalles()
	{
		return $this->hasMany(Consultadetalle::class, 'consulta_id');
	}

	public function consumos()
	{
		return $this->hasMany(Consumo::class, 'consulta_id');
	}

	public function estudiocomplementarios()
	{
		return $this->hasMany(Estudiocomplementario::class, 'consulta_id');
	}

	public function hc_aplicacion_vacuna_hcs()
	{
		return $this->hasMany(HcAplicacionVacunaHc::class, 'consulta_id');
	}

	public function hc_perinatal_hcs()
	{
		return $this->hasMany(HcPerinatalHc::class, 'consulta_id');
	}

	public function indicacions()
	{
		return $this->hasMany(Indicacion::class, 'consulta_id');
	}

	public function servicio_pacientes()
	{
		return $this->hasMany(ServicioPaciente::class, 'consulta_id');
	}
}
