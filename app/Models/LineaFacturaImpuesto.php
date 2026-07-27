<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LineaFacturaImpuesto
 * 
 * @property int $id
 * @property string $codigoImpuesto
 * @property float $alicuotaPorcentaje
 * @property Carbon $created_at
 * @property int $idLineaFactura
 * @property int $created_by
 * 
 * @property LineaFactura $linea_factura
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class LineaFacturaImpuesto extends Model
{
	protected $table = 'linea_factura_impuestos';
	public $timestamps = false;

	protected $casts = [
		'alicuotaPorcentaje' => 'float',
		'idLineaFactura' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'codigoImpuesto',
		'alicuotaPorcentaje',
		'idLineaFactura',
		'created_by'
	];

	public function linea_factura()
	{
		return $this->belongsTo(LineaFactura::class, 'idLineaFactura');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}
}
