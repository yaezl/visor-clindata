<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Factura
 * 
 * @property int $id
 * @property string $tipo
 * @property string|null $descripcion
 * @property int $numero
 * @property string|null $numero_manual
 * @property string|null $descripcion_manual
 * @property int|null $centrodecosto_id
 * @property bool $reintegrada
 * @property Carbon|null $fecha_vencimiento
 * @property Carbon|null $fecha_entrega
 * @property string|null $observacion
 * @property float|null $iva
 * @property bool $gravada
 * @property bool $impresa
 * @property int|null $caja_id
 * @property int|null $tipo_recaudo_id
 * @property int|null $formapago_id
 * @property bool $factura_en_lote
 * @property float $monto
 * 
 * @property TipoRecaudoFactura|null $tipo_recaudo_factura
 * @property Caja|null $caja
 * @property Formadepago|null $formadepago
 * @property Documento $documento
 * @property Centrodecosto|null $centrodecosto
 * @property Collection|Anulacionfactura[] $anulacionfacturas
 * @property Collection|DetalleFactura[] $detalle_facturas
 * @property Collection|FacturaLinea[] $factura_lineas
 * @property Collection|Prefactura[] $prefacturas
 * @property FacturacionElectronica|null $facturacion_electronica
 * @property Facturacriterio|null $facturacriterio
 * @property Collection|Facturacriterio[] $facturacriterios
 * @property Collection|Notacredito[] $notacreditos
 * @property Collection|Notadebito[] $notadebitos
 * @property Collection|Prefacturacriterio[] $prefacturacriterios
 * @property Collection|Recibo[] $recibos
 *
 * @package App\Models
 */
class Factura extends Model
{
	protected $table = 'factura';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'numero' => 'int',
		'centrodecosto_id' => 'int',
		'reintegrada' => 'bool',
		'fecha_vencimiento' => 'datetime',
		'fecha_entrega' => 'datetime',
		'iva' => 'float',
		'gravada' => 'bool',
		'impresa' => 'bool',
		'caja_id' => 'int',
		'tipo_recaudo_id' => 'int',
		'formapago_id' => 'int',
		'factura_en_lote' => 'bool',
		'monto' => 'float'
	];

	protected $fillable = [
		'tipo',
		'descripcion',
		'numero',
		'numero_manual',
		'descripcion_manual',
		'centrodecosto_id',
		'reintegrada',
		'fecha_vencimiento',
		'fecha_entrega',
		'observacion',
		'iva',
		'gravada',
		'impresa',
		'caja_id',
		'tipo_recaudo_id',
		'formapago_id',
		'factura_en_lote',
		'monto'
	];

	public function tipo_recaudo_factura()
	{
		return $this->belongsTo(TipoRecaudoFactura::class, 'tipo_recaudo_id');
	}

	public function caja()
	{
		return $this->belongsTo(Caja::class);
	}

	public function formadepago()
	{
		return $this->belongsTo(Formadepago::class, 'formapago_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function centrodecosto()
	{
		return $this->belongsTo(Centrodecosto::class);
	}

	public function anulacionfacturas()
	{
		return $this->hasMany(Anulacionfactura::class);
	}

	public function detalle_facturas()
	{
		return $this->hasMany(DetalleFactura::class);
	}

	public function factura_lineas()
	{
		return $this->hasMany(FacturaLinea::class);
	}

	public function prefacturas()
	{
		return $this->belongsToMany(Prefactura::class);
	}

	public function facturacion_electronica()
	{
		return $this->hasOne(FacturacionElectronica::class);
	}

	public function facturacriterio()
	{
		return $this->hasOne(Facturacriterio::class);
	}

	public function facturacriterios()
	{
		return $this->hasMany(Facturacriterio::class, 'factura_a_refacturar_id');
	}

	public function notacreditos()
	{
		return $this->hasMany(Notacredito::class);
	}

	public function notadebitos()
	{
		return $this->hasMany(Notadebito::class);
	}

	public function prefacturacriterios()
	{
		return $this->hasMany(Prefacturacriterio::class, 'factura_a_refacturar_id');
	}

	public function recibos()
	{
		return $this->belongsToMany(Recibo::class, 'recibo_factura')
					->withPivot('id', 'monto');
	}
}
