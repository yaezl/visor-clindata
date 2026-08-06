<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notadebito
 * 
 * @property int $id
 * @property int|null $factura_id
 * @property string|null $descripcion
 * @property int $numero
 * @property int|null $centrodecosto_id
 * @property int|null $motivodenota_id
 * @property bool $esManual
 * @property int|null $tipoCondicion
 * 
 * @property Motivodenotum|null $motivodenotum
 * @property Documento $documento
 * @property Factura|null $factura
 * @property Centrodecosto|null $centrodecosto
 * @property FacturacionElectronica|null $facturacion_electronica
 * @property Collection|Notaitem[] $notaitems
 *
 * @package App\Models
 */
class Notadebito extends Model
{
	protected $table = 'notadebito';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'factura_id' => 'int',
		'numero' => 'int',
		'centrodecosto_id' => 'int',
		'motivodenota_id' => 'int',
		'esManual' => 'bool',
		'tipoCondicion' => 'int'
	];

	protected $fillable = [
		'factura_id',
		'descripcion',
		'numero',
		'centrodecosto_id',
		'motivodenota_id',
		'esManual',
		'tipoCondicion'
	];

	public function motivodenotum()
	{
		return $this->belongsTo(Motivodenotum::class, 'motivodenota_id');
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function centrodecosto()
	{
		return $this->belongsTo(Centrodecosto::class);
	}

	public function facturacion_electronica()
	{
		return $this->hasOne(FacturacionElectronica::class, 'nota_debito_id');
	}

	public function notaitems()
	{
		return $this->hasMany(Notaitem::class);
	}
}
