<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HolterEstudio
 * 
 * @property int $id
 * @property Carbon|null $fechaEntregaEquipoPaciente
 * @property int $idUsuarioEntregaEquipo
 * @property Carbon|null $fechaDevolucionEquipo
 * @property int $idUsuarioRecibeEquipo
 * @property Carbon|null $fechaEntregaMedico
 * @property int $idUsuarioEntregaMedico
 * @property Carbon|null $fechaEntregaMesaEntrada
 * @property int $idUsuarioEntregaME
 * @property Carbon|null $fechaEntregaPaciente
 * @property int $idUsuarioEntregaEstudio
 * @property int|null $idEnfermero
 * @property int|null $idTipoEstudio
 * @property int|null $idEstadoEstudio
 * @property int|null $idObraSocial
 * @property int|null $idEquipo
 * @property int|null $idMedico
 * @property int $idPaciente
 * @property Carbon $fechaCreacion
 * @property Carbon|null $fechaEliminacion
 *
 * @package App\Models
 */
class HolterEstudio extends Model
{
	protected $table = 'holter_estudio';
	public $timestamps = false;

	protected $casts = [
		'fechaEntregaEquipoPaciente' => 'datetime',
		'idUsuarioEntregaEquipo' => 'int',
		'fechaDevolucionEquipo' => 'datetime',
		'idUsuarioRecibeEquipo' => 'int',
		'fechaEntregaMedico' => 'datetime',
		'idUsuarioEntregaMedico' => 'int',
		'fechaEntregaMesaEntrada' => 'datetime',
		'idUsuarioEntregaME' => 'int',
		'fechaEntregaPaciente' => 'datetime',
		'idUsuarioEntregaEstudio' => 'int',
		'idEnfermero' => 'int',
		'idTipoEstudio' => 'int',
		'idEstadoEstudio' => 'int',
		'idObraSocial' => 'int',
		'idEquipo' => 'int',
		'idMedico' => 'int',
		'idPaciente' => 'int',
		'fechaCreacion' => 'datetime',
		'fechaEliminacion' => 'datetime'
	];

	protected $fillable = [
		'fechaEntregaEquipoPaciente',
		'idUsuarioEntregaEquipo',
		'fechaDevolucionEquipo',
		'idUsuarioRecibeEquipo',
		'fechaEntregaMedico',
		'idUsuarioEntregaMedico',
		'fechaEntregaMesaEntrada',
		'idUsuarioEntregaME',
		'fechaEntregaPaciente',
		'idUsuarioEntregaEstudio',
		'idEnfermero',
		'idTipoEstudio',
		'idEstadoEstudio',
		'idObraSocial',
		'idEquipo',
		'idMedico',
		'idPaciente',
		'fechaCreacion',
		'fechaEliminacion'
	];
}
