<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesAprobacion
 * 
 * @property int $id
 * @property int|null $permiso_id
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * @property int|null $created_by
 * @property int|null $modified_by
 * 
 * @property Usuario|null $usuario
 * @property Permiso|null $permiso
 * @property Collection|AprobacionesEstado[] $aprobaciones_estados
 * @property Collection|AutorizacionAprobacione[] $autorizacion_aprobaciones
 * @property Collection|AutorizacionesAuditoriaEstado[] $autorizaciones_auditoria_estados
 *
 * @package App\Models
 */
class AutorizacionesAprobacion extends Model
{
	protected $table = 'autorizaciones_aprobacion';

	protected $casts = [
		'permiso_id' => 'int',
		'borrado_logico' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int'
	];

	protected $fillable = [
		'permiso_id',
		'nombre',
		'codigo',
		'borrado_logico',
		'created_by',
		'modified_by'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class);
	}

	public function aprobaciones_estados()
	{
		return $this->hasMany(AprobacionesEstado::class, 'aprobacion_id');
	}

	public function autorizacion_aprobaciones()
	{
		return $this->hasMany(AutorizacionAprobacione::class, 'aprobacion_id');
	}

	public function autorizaciones_auditoria_estados()
	{
		return $this->hasMany(AutorizacionesAuditoriaEstado::class, 'aprobacion_id');
	}
}
