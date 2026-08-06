<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEvolucion
 * 
 * @property int $id
 * @property int|null $persona_internacion_id
 * 
 * @property InternacionPersona|null $internacion_persona
 * @property Collection|EvolucionDescripcion[] $evolucion_descripcions
 *
 * @package App\Models
 */
class InternacionHojaEvolucion extends Model
{
	protected $table = 'internacion_hoja_evolucion';
	public $timestamps = false;

	protected $casts = [
		'persona_internacion_id' => 'int'
	];

	protected $fillable = [
		'persona_internacion_id'
	];

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function evolucion_descripcions()
	{
		return $this->hasMany(EvolucionDescripcion::class, 'hoja_evolucion_id');
	}
}
