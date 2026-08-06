<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PorcentajeIva
 * 
 * @property int $id
 * @property float $porcentaje_iva
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class PorcentajeIva extends Model
{
	protected $table = 'porcentaje_iva';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'porcentaje_iva' => 'float'
	];

	protected $fillable = [
		'porcentaje_iva'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
