<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemAdHoc
 * 
 * @property int $id
 * @property int $cantidad
 * @property string|null $texto
 * 
 * @property Collection|AutorizacionesItem[] $autorizaciones_items
 *
 * @package App\Models
 */
class ItemAdHoc extends Model
{
	protected $table = 'item_ad_hoc';
	public $timestamps = false;

	protected $casts = [
		'cantidad' => 'int'
	];

	protected $fillable = [
		'cantidad',
		'texto'
	];

	public function autorizaciones_items()
	{
		return $this->hasMany(AutorizacionesItem::class, 'item_id');
	}
}
