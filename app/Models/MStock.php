<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MStock
 * 
 * @property string|null $codigo
 * @property int|null $stock
 *
 * @package App\Models
 */
class MStock extends Model
{
	protected $table = 'm_stock';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'stock' => 'int'
	];

	protected $fillable = [
		'codigo',
		'stock'
	];
}
