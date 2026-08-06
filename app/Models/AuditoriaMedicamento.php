<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AuditoriaMedicamento
 * 
 * @property int $id
 * @property int $auditoria_id
 * @property int|null $articulo_prescripto_id
 * @property int $item_id
 * @property bool $eliminado
 * 
 * @property AutorizacionesItem $autorizaciones_item
 * @property Articuloprescripto|null $articuloprescripto
 * @property AutorizacionesAuditoriaEstado $autorizaciones_auditoria_estado
 *
 * @package App\Models
 */
class AuditoriaMedicamento extends Model
{
	protected $table = 'auditoria_medicamento';
	public $timestamps = false;

	protected $casts = [
		'auditoria_id' => 'int',
		'articulo_prescripto_id' => 'int',
		'item_id' => 'int',
		'eliminado' => 'bool'
	];

	protected $fillable = [
		'auditoria_id',
		'articulo_prescripto_id',
		'item_id',
		'eliminado'
	];

	public function autorizaciones_item()
	{
		return $this->belongsTo(AutorizacionesItem::class, 'item_id');
	}

	public function articuloprescripto()
	{
		return $this->belongsTo(Articuloprescripto::class, 'articulo_prescripto_id');
	}

	public function autorizaciones_auditoria_estado()
	{
		return $this->belongsTo(AutorizacionesAuditoriaEstado::class, 'auditoria_id');
	}
}
