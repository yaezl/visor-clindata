<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionMonto
 * 
 * @property int $id
 * @property float|null $montoTope
 * @property float|null $copagoVariable
 * @property float|null $copagoFijo
 * @property float|null $copagoMaterial
 *
 * @package App\Models
 */
class AutorizacionMonto extends Model
{
	protected $table = 'autorizacion_montos';
	public $timestamps = false;

	protected $casts = [
		'montoTope' => 'float',
		'copagoVariable' => 'float',
		'copagoFijo' => 'float',
		'copagoMaterial' => 'float'
	];

	protected $fillable = [
		'montoTope',
		'copagoVariable',
		'copagoFijo',
		'copagoMaterial'
	];
}
