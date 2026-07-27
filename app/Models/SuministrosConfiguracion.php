<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosConfiguracion
 * 
 * @property int $id
 * @property int $numero_de_orden
 * @property int $numero_de_acta
 * @property int $numero_provisorio
 * @property string|null $prefijo_numero_provisorio
 *
 * @package App\Models
 */
class SuministrosConfiguracion extends Model
{
	protected $table = 'suministros_configuracion';
	public $timestamps = false;

	protected $casts = [
		'numero_de_orden' => 'int',
		'numero_de_acta' => 'int',
		'numero_provisorio' => 'int'
	];

	protected $fillable = [
		'numero_de_orden',
		'numero_de_acta',
		'numero_provisorio',
		'prefijo_numero_provisorio'
	];
}
