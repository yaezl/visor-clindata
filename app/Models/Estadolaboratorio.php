<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estadolaboratorio
 * 
 * @property int $id
 * @property string $codigoEstadoLaboratorio
 * @property string $nombreEstadoLaboratorio
 *
 * @package App\Models
 */
class Estadolaboratorio extends Model
{
	protected $table = 'estadolaboratorio';
	public $timestamps = false;

	protected $fillable = [
		'codigoEstadoLaboratorio',
		'nombreEstadoLaboratorio'
	];
}
