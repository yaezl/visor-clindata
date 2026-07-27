<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BonoHojaconsumo
 * 
 * @property int $hojaconsumo_id
 * @property int $bono_id
 * 
 * @property HojaConsumo $hoja_consumo
 * @property Bono $bono
 *
 * @package App\Models
 */
class BonoHojaconsumo extends Model
{
	protected $table = 'bono_hojaconsumo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'hojaconsumo_id' => 'int',
		'bono_id' => 'int'
	];

	public function hoja_consumo()
	{
		return $this->belongsTo(HojaConsumo::class, 'hojaconsumo_id');
	}

	public function bono()
	{
		return $this->belongsTo(Bono::class);
	}
}
