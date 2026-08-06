<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Datoscsv
 * 
 * @property int $id
 * @property string $llamadaentrante
 * @property string $llamadafinalizada
 * @property int $duracion
 * @property string $respuesta
 * @property string $cod_usuario
 *
 * @package App\Models
 */
class Datoscsv extends Model
{
	protected $table = 'datoscsv';
	public $timestamps = false;

	protected $casts = [
		'duracion' => 'int'
	];

	protected $fillable = [
		'llamadaentrante',
		'llamadafinalizada',
		'duracion',
		'respuesta',
		'cod_usuario'
	];
}
