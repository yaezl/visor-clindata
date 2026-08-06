<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReciboFactura
 * 
 * @property int $id
 * @property int|null $factura_id
 * @property int|null $recibo_id
 * @property float $monto
 * 
 * @property Factura|null $factura
 * @property Recibo|null $recibo
 *
 * @package App\Models
 */
class ReciboFactura extends Model
{
	protected $table = 'recibo_factura';
	public $timestamps = false;

	protected $casts = [
		'factura_id' => 'int',
		'recibo_id' => 'int',
		'monto' => 'float'
	];

	protected $fillable = [
		'factura_id',
		'recibo_id',
		'monto'
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function recibo()
	{
		return $this->belongsTo(Recibo::class);
	}
}
