<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Consumo
 * 
 * @property int $id
 * @property float $cantidad
 * @property int $consulta_id
 * @property int $articulotipopresentacion_id
 * 
 * @property Consultum $consultum
 * @property ArticuloTipopresentacion $articulo_tipopresentacion
 *
 * @package App\Models
 */
class Consumo extends Model
{
	protected $table = 'consumos';
	public $timestamps = false;

	protected $casts = [
		'cantidad' => 'float',
		'consulta_id' => 'int',
		'articulotipopresentacion_id' => 'int'
	];

	protected $fillable = [
		'cantidad',
		'consulta_id',
		'articulotipopresentacion_id'
	];

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}
}
