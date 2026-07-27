<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Portalcardiologium
 * 
 * @property int $id_estudio
 * @property string|null $tipo_estudio
 * @property string|null $dni_paciente
 * @property Carbon|null $fecha_subida
 * @property Carbon|null $fecha_envio
 * @property string|null $idusuario_subido
 * @property string|null $idusuario_envio
 * @property string|null $estado_envio
 * @property Carbon|null $fecha_estudio
 * @property string|null $archivo
 * @property string|null $email
 * @property string|null $nombre_paciente
 * @property string|null $apellido_paciente
 * @property int|null $eliminado
 *
 * @package App\Models
 */
class Portalcardiologium extends Model
{
	protected $table = 'portalcardiologia';
	protected $primaryKey = 'id_estudio';
	public $timestamps = false;

	protected $casts = [
		'fecha_subida' => 'datetime',
		'fecha_envio' => 'datetime',
		'fecha_estudio' => 'datetime',
		'eliminado' => 'int'
	];

	protected $fillable = [
		'tipo_estudio',
		'dni_paciente',
		'fecha_subida',
		'fecha_envio',
		'idusuario_subido',
		'idusuario_envio',
		'estado_envio',
		'fecha_estudio',
		'archivo',
		'email',
		'nombre_paciente',
		'apellido_paciente',
		'eliminado'
	];
}
