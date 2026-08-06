<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Anulacionfactura
 * 
 * @property int $id
 * @property int|null $factura_id
 * @property string|null $observacion
 * 
 * @property Factura|null $factura
 * @property Documento $documento
 *
 * @package App\Models
 */
class Anulacionfactura extends Model
{
	protected $table = 'anulacionfactura';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'factura_id' => 'int'
	];

	protected $fillable = [
		'factura_id',
		'observacion'
	];

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}
}
