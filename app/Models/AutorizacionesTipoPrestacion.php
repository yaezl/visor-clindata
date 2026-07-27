<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesTipoPrestacion
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string $nombre
 * @property string $codigo
 * @property bool $borrado_logico
 * @property bool $permite_autorizar
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $restringe_items
 * @property bool $autorizacion_agrupable
 * 
 * @property Usuario|null $usuario
 * @property Collection|AutorizacionesAuditoriaEstado[] $autorizaciones_auditoria_estados
 *
 * @package App\Models
 */
class AutorizacionesTipoPrestacion extends Model
{
	protected $table = 'autorizaciones_tipo_prestacion';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool',
		'permite_autorizar' => 'bool',
		'modified_at' => 'datetime',
		'restringe_items' => 'bool',
		'autorizacion_agrupable' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre',
		'codigo',
		'borrado_logico',
		'permite_autorizar',
		'modified_at',
		'restringe_items',
		'autorizacion_agrupable'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function autorizaciones_auditoria_estados()
	{
		return $this->hasMany(AutorizacionesAuditoriaEstado::class, 'tipo_prestacion_id');
	}
}
