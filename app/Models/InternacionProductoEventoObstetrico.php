<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionProductoEventoObstetrico
 * 
 * @property int $id
 * @property int $evento_obstetrico_id
 * @property int $peso_al_nacer
 * @property int $condicion_al_nacer
 * @property int $terminacion
 * @property int $sexo
 * 
 * @property InternacionEventoObstetrico $internacion_evento_obstetrico
 *
 * @package App\Models
 */
class InternacionProductoEventoObstetrico extends Model
{
	protected $table = 'internacion_producto_evento_obstetrico';
	public $timestamps = false;

	protected $casts = [
		'evento_obstetrico_id' => 'int',
		'peso_al_nacer' => 'int',
		'condicion_al_nacer' => 'int',
		'terminacion' => 'int',
		'sexo' => 'int'
	];

	protected $fillable = [
		'evento_obstetrico_id',
		'peso_al_nacer',
		'condicion_al_nacer',
		'terminacion',
		'sexo'
	];

	public function internacion_evento_obstetrico()
	{
		return $this->belongsTo(InternacionEventoObstetrico::class, 'evento_obstetrico_id');
	}
}
