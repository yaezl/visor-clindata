<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Enfermerium
 * 
 * @property int $id
 * @property int|null $medicion_id
 * @property string|null $detalle_actuacion
 * @property int|null $criterio_turno
 * @property string|null $especialidad_turno
 * @property int|null $valoracion_dolor
 * @property string|null $riesgo_caidas
 * 
 * @property Medicion|null $medicion
 * @property Consultadetalle $consultadetalle
 * @property Collection|EnfermeriaPrestacionEnfermerium[] $enfermeria_prestacion_enfermeria
 *
 * @package App\Models
 */
class Enfermerium extends Model
{
	protected $table = 'enfermeria';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'medicion_id' => 'int',
		'criterio_turno' => 'int',
		'valoracion_dolor' => 'int'
	];

	protected $fillable = [
		'medicion_id',
		'detalle_actuacion',
		'criterio_turno',
		'especialidad_turno',
		'valoracion_dolor',
		'riesgo_caidas'
	];

	public function medicion()
	{
		return $this->belongsTo(Medicion::class);
	}

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function enfermeria_prestacion_enfermeria()
	{
		return $this->hasMany(EnfermeriaPrestacionEnfermerium::class, 'enfermeria_id');
	}
}
