<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prefacturaitem
 * 
 * @property int $id
 * @property int|null $prefactura_id
 * @property int|null $cotizacion_id
 * @property int|null $bono_id
 * 
 * @property Prefactura|null $prefactura
 * @property Cotizacion|null $cotizacion
 * @property Bono|null $bono
 *
 * @package App\Models
 */
class Prefacturaitem extends Model
{
	protected $table = 'prefacturaitem';
	public $timestamps = false;

	protected $casts = [
		'prefactura_id' => 'int',
		'cotizacion_id' => 'int',
		'bono_id' => 'int'
	];

	protected $fillable = [
		'prefactura_id',
		'cotizacion_id',
		'bono_id'
	];

	public function prefactura()
	{
		return $this->belongsTo(Prefactura::class);
	}

	public function cotizacion()
	{
		return $this->belongsTo(Cotizacion::class);
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}
}
