<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionProfesionalPq
 * 
 * @property int $id
 * @property int|null $parte_id
 * @property int|null $profesional_id
 * @property int|null $rol_id
 * @property int $borrado_logico
 * 
 * @property InternacionParteQuirurgico|null $internacion_parte_quirurgico
 * @property Personal|null $personal
 * @property InternacionRol|null $internacion_rol
 *
 * @package App\Models
 */
class InternacionProfesionalPq extends Model
{
	protected $table = 'internacion_profesional_pq';
	public $timestamps = false;

	protected $casts = [
		'parte_id' => 'int',
		'profesional_id' => 'int',
		'rol_id' => 'int',
		'borrado_logico' => 'int'
	];

	protected $fillable = [
		'parte_id',
		'profesional_id',
		'rol_id',
		'borrado_logico'
	];

	public function internacion_parte_quirurgico()
	{
		return $this->belongsTo(InternacionParteQuirurgico::class, 'parte_id');
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class, 'profesional_id');
	}

	public function internacion_rol()
	{
		return $this->belongsTo(InternacionRol::class, 'rol_id');
	}
}
