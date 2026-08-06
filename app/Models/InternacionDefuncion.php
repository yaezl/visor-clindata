<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionDefuncion
 * 
 * @property int $id
 * @property int|null $diagnostico_final_id
 * @property int|null $diagnostico_intermedio_id
 * @property int|null $diagnostico_basico_id
 * @property bool|null $realizo_necropsia
 * 
 * @property Diagnostico|null $diagnostico
 * @property InternacionMovimiento|null $internacion_movimiento
 *
 * @package App\Models
 */
class InternacionDefuncion extends Model
{
	protected $table = 'internacion_defuncion';
	public $timestamps = false;

	protected $casts = [
		'diagnostico_final_id' => 'int',
		'diagnostico_intermedio_id' => 'int',
		'diagnostico_basico_id' => 'int',
		'realizo_necropsia' => 'bool'
	];

	protected $fillable = [
		'diagnostico_final_id',
		'diagnostico_intermedio_id',
		'diagnostico_basico_id',
		'realizo_necropsia'
	];

	public function diagnostico()
	{
		return $this->belongsTo(Diagnostico::class, 'diagnostico_final_id');
	}

	public function internacion_movimiento()
	{
		return $this->hasOne(InternacionMovimiento::class, 'defuncion_id');
	}
}
