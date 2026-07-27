<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PediatriaPercentil
 * 
 * @property int $id
 * @property int|null $pediatria_parametro_id
 * @property int|null $mes
 * @property float|null $p3
 * @property float|null $p15
 * @property float|null $p50
 * @property float|null $p85
 * @property float|null $p97
 * @property string $sexo
 * 
 * @property PediatriaParametro|null $pediatria_parametro
 *
 * @package App\Models
 */
class PediatriaPercentil extends Model
{
	protected $table = 'pediatria_percentil';
	public $timestamps = false;

	protected $casts = [
		'pediatria_parametro_id' => 'int',
		'mes' => 'int',
		'p3' => 'float',
		'p15' => 'float',
		'p50' => 'float',
		'p85' => 'float',
		'p97' => 'float'
	];

	protected $fillable = [
		'pediatria_parametro_id',
		'mes',
		'p3',
		'p15',
		'p50',
		'p85',
		'p97',
		'sexo'
	];

	public function pediatria_parametro()
	{
		return $this->belongsTo(PediatriaParametro::class);
	}
}
