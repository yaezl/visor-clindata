<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TedefItemFacturacion
 * 
 * @property int $id
 * @property int|null $lote_id
 * @property int $facturaElectronica_id
 * 
 * @property FacturacionElectronica $facturacion_electronica
 * @property TedefLotesFacturacion|null $tedef_lotes_facturacion
 *
 * @package App\Models
 */
class TedefItemFacturacion extends Model
{
	protected $table = 'tedef_item_facturacion';
	public $timestamps = false;

	protected $casts = [
		'lote_id' => 'int',
		'facturaElectronica_id' => 'int'
	];

	protected $fillable = [
		'lote_id',
		'facturaElectronica_id'
	];

	public function facturacion_electronica()
	{
		return $this->belongsTo(FacturacionElectronica::class, 'facturaElectronica_id');
	}

	public function tedef_lotes_facturacion()
	{
		return $this->belongsTo(TedefLotesFacturacion::class, 'lote_id');
	}
}
