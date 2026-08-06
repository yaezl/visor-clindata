<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleFactura
 * 
 * @property int $id
 * @property int|null $factura_id
 * @property string|null $detalle
 * @property float $monto
 * 
 * @property Factura|null $factura
 *
 * @package App\Models
 */
class DetalleFactura extends Model
{
	protected $table = 'detalle_factura';
	public $timestamps = false;

	protected $casts = [
		'factura_id' => 'int',
		'monto' => 'float'
	];

	protected $fillable = [
		'factura_id',
		'detalle',
		'monto'
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}
}
