<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FacturaLinea
 * 
 * @property int $factura_id
 * @property int $linea_id
 * 
 * @property LineaFactura $linea_factura
 * @property Factura $factura
 *
 * @package App\Models
 */
class FacturaLinea extends Model
{
	protected $table = 'factura_lineas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'factura_id' => 'int',
		'linea_id' => 'int'
	];

	public function linea_factura()
	{
		return $this->belongsTo(LineaFactura::class, 'linea_id');
	}

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}
}
