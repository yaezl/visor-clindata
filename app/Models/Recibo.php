<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recibo
 * 
 * @property int $id
 * @property int|null $anulacionrecibo_id
 * @property int $numero
 * @property string|null $concepto
 * @property string|null $numero_manual
 * @property string|null $descripcion_manual
 * @property int|null $centrodecosto_id
 * @property string|null $numero_electronico
 * @property int|null $caja_id
 * 
 * @property Caja|null $caja
 * @property Documento $documento
 * @property Centrodecosto|null $centrodecosto
 * @property Collection|Anulacionrecibo[] $anulacionrecibos
 * @property Collection|Factura[] $facturas
 * @property Collection|Recibopago[] $recibopagos
 *
 * @package App\Models
 */
class Recibo extends Model
{
	protected $table = 'recibo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'anulacionrecibo_id' => 'int',
		'numero' => 'int',
		'centrodecosto_id' => 'int',
		'caja_id' => 'int'
	];

	protected $fillable = [
		'anulacionrecibo_id',
		'numero',
		'concepto',
		'numero_manual',
		'descripcion_manual',
		'centrodecosto_id',
		'numero_electronico',
		'caja_id'
	];

	public function caja()
	{
		return $this->belongsTo(Caja::class);
	}

	public function documento()
	{
		return $this->belongsTo(Documento::class, 'id');
	}

	public function centrodecosto()
	{
		return $this->belongsTo(Centrodecosto::class);
	}

	public function anulacionrecibos()
	{
		return $this->hasMany(Anulacionrecibo::class);
	}

	public function facturas()
	{
		return $this->belongsToMany(Factura::class, 'recibo_factura')
					->withPivot('id', 'monto');
	}

	public function recibopagos()
	{
		return $this->hasMany(Recibopago::class);
	}
}
