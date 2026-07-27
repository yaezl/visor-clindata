<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class IndicacionEsteticaDetalle
 * 
 * @property int $id
 * @property int|null $dermatologia_id
 * @property string $grado
 * @property string $localizacion
 * @property int|null $indicacionEstetica_id
 * 
 * @property IndicacionEstetica|null $indicacion_estetica
 * @property Dermatologium|null $dermatologium
 *
 * @package App\Models
 */
class IndicacionEsteticaDetalle extends Model
{
	protected $table = 'IndicacionEsteticaDetalle';
	public $timestamps = false;

	protected $casts = [
		'dermatologia_id' => 'int',
		'indicacionEstetica_id' => 'int'
	];

	protected $fillable = [
		'dermatologia_id',
		'grado',
		'localizacion',
		'indicacionEstetica_id'
	];

	public function indicacion_estetica()
	{
		return $this->belongsTo(IndicacionEstetica::class, 'indicacionEstetica_id');
	}

	public function dermatologium()
	{
		return $this->belongsTo(Dermatologium::class, 'dermatologia_id');
	}
}
