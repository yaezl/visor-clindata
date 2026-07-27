<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FacturacionElectronica
 * 
 * @property int $id
 * @property int|null $factura_id
 * @property int|null $nota_credito_id
 * @property int|null $nota_debito_id
 * @property int|null $id_comprobante
 * @property string|null $numero
 * @property string|null $cae
 * @property string|null $cai
 * @property Carbon|null $fecha
 * @property Carbon|null $fecha_vto_cae
 * @property string|null $estado
 * @property Carbon|null $fecha_vto
 * @property string|null $rg2485
 * @property string|null $tipoComprobante
 * @property string|null $pdf
 * @property string|null $xml
 * @property int|null $cancelacionDocumento_id
 * @property string|null $pdfBase64
 * @property string|null $codigoQr
 * @property bool|null $adjuntoCargado
 * @property string|null $errorAdjunto
 * @property Carbon|null $adjuntoCargadoFecha
 * @property string|null $xmlResponse
 * 
 * @property CancelacionDocumento|null $cancelacion_documento
 * @property Factura|null $factura
 * @property Notacredito|null $notacredito
 * @property Notadebito|null $notadebito
 * @property TedefItemFacturacion|null $tedef_item_facturacion
 *
 * @package App\Models
 */
class FacturacionElectronica extends Model
{
	protected $table = 'facturacion_electronica';
	public $timestamps = false;

	protected $casts = [
		'factura_id' => 'int',
		'nota_credito_id' => 'int',
		'nota_debito_id' => 'int',
		'id_comprobante' => 'int',
		'fecha' => 'datetime',
		'fecha_vto_cae' => 'datetime',
		'fecha_vto' => 'datetime',
		'cancelacionDocumento_id' => 'int',
		'adjuntoCargado' => 'bool',
		'adjuntoCargadoFecha' => 'datetime'
	];

	protected $fillable = [
		'factura_id',
		'nota_credito_id',
		'nota_debito_id',
		'id_comprobante',
		'numero',
		'cae',
		'cai',
		'fecha',
		'fecha_vto_cae',
		'estado',
		'fecha_vto',
		'rg2485',
		'tipoComprobante',
		'pdf',
		'xml',
		'cancelacionDocumento_id',
		'pdfBase64',
		'codigoQr',
		'adjuntoCargado',
		'errorAdjunto',
		'adjuntoCargadoFecha',
		'xmlResponse'
	];

	public function cancelacion_documento()
	{
		return $this->belongsTo(CancelacionDocumento::class, 'cancelacionDocumento_id');
	}

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function notacredito()
	{
		return $this->belongsTo(Notacredito::class, 'nota_credito_id');
	}

	public function notadebito()
	{
		return $this->belongsTo(Notadebito::class, 'nota_debito_id');
	}

	public function tedef_item_facturacion()
	{
		return $this->hasOne(TedefItemFacturacion::class, 'facturaElectronica_id');
	}
}
