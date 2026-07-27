<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dinero
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $item_id
 * 
 * @property Item|null $item
 *
 * @package App\Models
 */
class Dinero extends Model
{
	protected $table = 'dinero';
	public $timestamps = false;

	protected $casts = [
		'item_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'item_id'
	];

	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
