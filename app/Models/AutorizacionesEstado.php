<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesEstado
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * @property bool $solo_auditoria
 * @property int|null $permiso_id
 * @property string|null $color
 * @property bool $fijo
 * @property bool $logico
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property bool $final
 * @property bool $permite_imprimir
 * 
 * @property Usuario|null $usuario
 * @property Permiso|null $permiso
 * @property Collection|AprobacionesEstado[] $aprobaciones_estados
 * @property Collection|AutorizacionesAuditoriaEstado[] $autorizaciones_auditoria_estados
 * @property Collection|AutorizacionesEstadosAnterioresAceptado[] $autorizaciones_estados_anteriores_aceptados
 *
 * @package App\Models
 */
class AutorizacionesEstado extends Model
{
	protected $table = 'autorizaciones_estado';

	protected $casts = [
		'borrado_logico' => 'bool',
		'solo_auditoria' => 'bool',
		'permiso_id' => 'int',
		'fijo' => 'bool',
		'logico' => 'bool',
		'created_by' => 'int',
		'modified_by' => 'int',
		'final' => 'bool',
		'permite_imprimir' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'codigo',
		'borrado_logico',
		'solo_auditoria',
		'permiso_id',
		'color',
		'fijo',
		'logico',
		'created_by',
		'modified_by',
		'final',
		'permite_imprimir'
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
		return $this->hasMany(AprobacionesEstado::class, 'estado_id');
	}

	public function autorizaciones_auditoria_estados()
	{
		return $this->hasMany(AutorizacionesAuditoriaEstado::class, 'estado_id');
	}

	public function autorizaciones_estados_anteriores_aceptados()
	{
		return $this->hasMany(AutorizacionesEstadosAnterioresAceptado::class, 'estado_id');
	}
}
