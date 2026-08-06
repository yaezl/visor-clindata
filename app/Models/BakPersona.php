<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BakPersona
 * 
 * @property int $id
 * @property int $direccion_id
 * @property int|null $cuenta_id
 * @property int $pais_id
 * @property int $estado_civil_id
 * @property int $tipo_documento_id
 * @property string $documento
 * @property string $apellidos
 * @property string $nombres
 * @property string $apellido_materno
 * @property Carbon $fecha_nacimiento
 * @property string $genero
 * @property string $telefono
 * @property string $celular
 * @property string $cuil
 * @property string $email
 * @property string|null $nro_hc
 * @property Carbon $created_at
 * @property int $created_by
 * @property Carbon $updated_at
 * @property int $modified_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $estado_id
 * @property string|null $comentario_telefonos
 * @property bool $telfijorecibemsjs
 * @property int|null $empleador_id
 * @property string|null $nombre_alias
 * @property bool|null $usar_nombre_alias
 * @property string|null $edad_aproximada
 * @property string $sexo
 * @property int|null $nivelinstruccion_id
 * @property bool|null $usar_edad_aproximada
 * @property Carbon|null $fecha_edad_aproximada
 * @property string|null $estado_msg
 * @property int|null $causa_hc_pasiva_id
 * @property int|null $grupo_sanguineo_id
 * @property int|null $mp_id
 *
 * @package App\Models
 */
class BakPersona extends Model
{
	use SoftDeletes;
	protected $table = 'bak_persona';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'direccion_id' => 'int',
		'cuenta_id' => 'int',
		'pais_id' => 'int',
		'estado_civil_id' => 'int',
		'tipo_documento_id' => 'int',
		'fecha_nacimiento' => 'datetime',
		'created_by' => 'int',
		'modified_by' => 'int',
		'deleted_by' => 'int',
		'estado_id' => 'int',
		'telfijorecibemsjs' => 'bool',
		'empleador_id' => 'int',
		'usar_nombre_alias' => 'bool',
		'nivelinstruccion_id' => 'int',
		'usar_edad_aproximada' => 'bool',
		'fecha_edad_aproximada' => 'datetime',
		'causa_hc_pasiva_id' => 'int',
		'grupo_sanguineo_id' => 'int',
		'mp_id' => 'int'
	];

	protected $fillable = [
		'id',
		'direccion_id',
		'cuenta_id',
		'pais_id',
		'estado_civil_id',
		'tipo_documento_id',
		'documento',
		'apellidos',
		'nombres',
		'apellido_materno',
		'fecha_nacimiento',
		'genero',
		'telefono',
		'celular',
		'cuil',
		'email',
		'nro_hc',
		'created_by',
		'modified_by',
		'deleted_by',
		'estado_id',
		'comentario_telefonos',
		'telfijorecibemsjs',
		'empleador_id',
		'nombre_alias',
		'usar_nombre_alias',
		'edad_aproximada',
		'sexo',
		'nivelinstruccion_id',
		'usar_edad_aproximada',
		'fecha_edad_aproximada',
		'estado_msg',
		'causa_hc_pasiva_id',
		'grupo_sanguineo_id',
		'mp_id'
	];
}
