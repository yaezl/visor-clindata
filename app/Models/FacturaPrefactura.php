<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FacturaPrefactura
 * 
 * @property int $factura_id
 * @property int $prefactura_id
 * 
 * @property Factura $factura
 * @property Prefactura $prefactura
 *
 * @package App\Models
 */
class FacturaPrefactura extends Model
{
	protected $table = 'factura_prefactura';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'factura_id' => 'int',
		'prefactura_id' => 'int'
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function prefactura()
	{
		return $this->belongsTo(Prefactura::class);
	}
}
