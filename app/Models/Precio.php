<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Precio
 * 
 * @property int $id
 * @property float $monto
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class Precio extends Model
{
	protected $table = 'precio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'monto' => 'float'
	];

	protected $fillable = [
		'monto'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
