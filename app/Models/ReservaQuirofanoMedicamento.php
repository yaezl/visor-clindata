<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReservaQuirofanoMedicamento
 * 
 * @property int $id
 * @property int $reserva_quirofano_id
 * @property int $articulo_tipo_presentacion_id
 * @property int $cantidad
 * 
 * @property ReservaQuirofano $reserva_quirofano
 * @property ArticuloTipopresentacion $articulo_tipopresentacion
 *
 * @package App\Models
 */
class ReservaQuirofanoMedicamento extends Model
{
	protected $table = 'reserva_quirofano_medicamento';
	public $timestamps = false;

	protected $casts = [
		'reserva_quirofano_id' => 'int',
		'articulo_tipo_presentacion_id' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'reserva_quirofano_id',
		'articulo_tipo_presentacion_id',
		'cantidad'
	];

	public function reserva_quirofano()
	{
		return $this->belongsTo(ReservaQuirofano::class);
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulo_tipo_presentacion_id');
	}
}
