<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CancelacionDocumento
 * 
 * @property int $id
 * @property int $numero
 * @property int $documentoFacturacion_id
 * @property string|null $motivoCancelacion
 * 
 * @property Documentofacturacion $documentofacturacion
 * @property Documento $documento
 * @property FacturacionElectronica|null $facturacion_electronica
 *
 * @package App\Models
 */
class CancelacionDocumento extends Model
{
	protected $table = 'cancelacion_documento';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'numero' => 'int',
		'documentoFacturacion_id' => 'int'
	];

	protected $fillable = [
		'numero',
		'documentoFacturacion_id',
		'motivoCancelacion'
	];

	public function documentofacturacion()
	{
		return $this->belongsTo(Documentofacturacion::class, 'documentoFacturacion_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function facturacion_electronica()
	{
		return $this->hasOne(FacturacionElectronica::class, 'cancelacionDocumento_id');
	}
}
