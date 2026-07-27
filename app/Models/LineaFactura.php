<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LineaFactura
 * 
 * @property int $id
 * @property float $monto
 * @property string $descripcion
 * @property int $cantidad
 * @property int|null $item_bono_ref
 * @property int|null $factura_id
 * 
 * @property FacturaLinea|null $factura_linea
 * @property Collection|LineaFacturaImpuesto[] $linea_factura_impuestos
 *
 * @package App\Models
 */
class LineaFactura extends Model
{
	protected $table = 'linea_factura';
	public $timestamps = false;

	protected $casts = [
		'monto' => 'float',
		'cantidad' => 'int',
		'item_bono_ref' => 'int',
		'factura_id' => 'int'
	];

	protected $fillable = [
		'monto',
		'descripcion',
		'cantidad',
		'item_bono_ref',
		'factura_id'
	];

	public function factura_linea()
	{
		return $this->hasOne(FacturaLinea::class, 'linea_id');
	}

	public function linea_factura_impuestos()
	{
		return $this->hasMany(LineaFacturaImpuesto::class, 'idLineaFactura');
	}
}
