<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UnidadProgramaticaInstitucione
 * 
 * @property int $unidad_programatica_id
 * @property int $institucion_id
 * 
 * @property UnidadProgramatica $unidad_programatica
 * @property Institucion $institucion
 *
 * @package App\Models
 */
class UnidadProgramaticaInstitucione extends Model
{
	protected $table = 'unidad_programatica_instituciones';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'unidad_programatica_id' => 'int',
		'institucion_id' => 'int'
	];

	public function unidad_programatica()
	{
		return $this->belongsTo(UnidadProgramatica::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
