<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesItem
 * 
 * @property int $id
 * @property int|null $estudio_id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $item_id
 * @property int $cantidad
 * @property string|null $observacion
 * @property float $copago
 * @property float $precio
 * 
 * @property ItemAdHoc|null $item_ad_hoc
 * @property Estudio|null $estudio
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Collection|AuditoriaEstudio[] $auditoria_estudios
 * @property Collection|AuditoriaMedicamento[] $auditoria_medicamentos
 * @property Collection|AutorizacionItem[] $autorizacion_items
 *
 * @package App\Models
 */
class AutorizacionesItem extends Model
{
	protected $table = 'autorizaciones_items';
	public $timestamps = false;

	protected $casts = [
		'estudio_id' => 'int',
		'articulotipopresentacion_id' => 'int',
		'item_id' => 'int',
		'cantidad' => 'int',
		'copago' => 'float',
		'precio' => 'float'
	];

	protected $fillable = [
		'estudio_id',
		'articulotipopresentacion_id',
		'item_id',
		'cantidad',
		'observacion',
		'copago',
		'precio'
	];

	public function item_ad_hoc()
	{
		return $this->belongsTo(ItemAdHoc::class, 'item_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function auditoria_estudios()
	{
		return $this->hasMany(AuditoriaEstudio::class, 'item_id');
	}

	public function auditoria_medicamentos()
	{
		return $this->hasMany(AuditoriaMedicamento::class, 'item_id');
	}

	public function autorizacion_items()
	{
		return $this->hasMany(AutorizacionItem::class, 'item_id');
	}
}
