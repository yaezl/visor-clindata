<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Efectivo
 * 
 * @property int $id
 * @property string|null $descripcion
 * 
 * @property Recibopago $recibopago
 *
 * @package App\Models
 */
class Efectivo extends Model
{
	protected $table = 'efectivo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'descripcion'
	];

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}
}
