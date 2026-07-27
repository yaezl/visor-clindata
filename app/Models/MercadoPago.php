<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MercadoPago
 * 
 * @property int $id
 * @property string|null $descripcion
 * @property string|null $nroTransaccion
 * 
 * @property Recibopago $recibopago
 *
 * @package App\Models
 */
class MercadoPago extends Model
{
	protected $table = 'mercado_pago';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'nroTransaccion'
	];

	public function recibopago()
	{
		return $this->belongsTo(Recibopago::class, 'id');
	}
}
