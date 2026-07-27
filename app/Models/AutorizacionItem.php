<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionItem
 * 
 * @property int $autorizacion_id
 * @property int $item_id
 * 
 * @property AutorizacionesItem $autorizaciones_item
 * @property AutorizacionesAutorizacion $autorizaciones_autorizacion
 *
 * @package App\Models
 */
class AutorizacionItem extends Model
{
	protected $table = 'autorizacion_items';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'autorizacion_id' => 'int',
		'item_id' => 'int'
	];

	public function autorizaciones_item()
	{
		return $this->belongsTo(AutorizacionesItem::class, 'item_id');
	}

	public function autorizaciones_autorizacion()
	{
		return $this->belongsTo(AutorizacionesAutorizacion::class, 'autorizacion_id');
	}
}
