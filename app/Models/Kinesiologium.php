<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kinesiologium
 * 
 * @property int $id
 * @property int|null $tratamiento_id
 * @property string|null $observacion
 * @property string|null $matricula_derivacion
 * @property string|null $fecha_derivacion
 * @property string|null $fecha_sesion
 * 
 * @property TratamientoKinesiologium|null $tratamiento_kinesiologium
 * @property Consultadetalle $consultadetalle
 * @property Collection|KinesiologiaTratamiento[] $kinesiologia_tratamientos
 *
 * @package App\Models
 */
class Kinesiologium extends Model
{
	protected $table = 'kinesiologia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'tratamiento_id' => 'int'
	];

	protected $fillable = [
		'tratamiento_id',
		'observacion',
		'matricula_derivacion',
		'fecha_derivacion',
		'fecha_sesion'
	];

	public function tratamiento_kinesiologium()
	{
		return $this->belongsTo(TratamientoKinesiologium::class, 'tratamiento_id');
	}

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function kinesiologia_tratamientos()
	{
		return $this->hasMany(KinesiologiaTratamiento::class, 'kinesiologia_id');
	}
}
