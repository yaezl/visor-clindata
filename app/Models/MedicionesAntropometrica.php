<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MedicionesAntropometrica
 * 
 * @property int $id
 * @property int $persona_id
 * @property int $created_by
 * @property int $modified_by
 * @property Carbon $fecha
 * @property float|null $peso
 * @property float|null $talla
 * @property string|null $deporte
 * @property string|null $sedentario
 * @property float|null $triceps
 * @property float|null $subescapular
 * @property float|null $suprailiaco
 * @property float|null $abdominal
 * @property float|null $pantorrilla
 * @property float|null $muñeca
 * @property float|null $codo
 * @property float|null $rodilla
 * @property float|null $biceps
 * @property float|null $pierna
 * @property float|null $cintura
 * @property float|null $cadera
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Persona $persona
 * @property Collection|DietaPaciente[] $dieta_pacientes
 * @property Collection|EntrenamientoPaciente[] $entrenamiento_pacientes
 *
 * @package App\Models
 */
class MedicionesAntropometrica extends Model
{
	protected $table = 'mediciones_antropometricas';

	protected $casts = [
		'persona_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'fecha' => 'datetime',
		'peso' => 'float',
		'talla' => 'float',
		'triceps' => 'float',
		'subescapular' => 'float',
		'suprailiaco' => 'float',
		'abdominal' => 'float',
		'pantorrilla' => 'float',
		'muñeca' => 'float',
		'codo' => 'float',
		'rodilla' => 'float',
		'biceps' => 'float',
		'pierna' => 'float',
		'cintura' => 'float',
		'cadera' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'persona_id',
		'created_by',
		'modified_by',
		'fecha',
		'peso',
		'talla',
		'deporte',
		'sedentario',
		'triceps',
		'subescapular',
		'suprailiaco',
		'abdominal',
		'pantorrilla',
		'muñeca',
		'codo',
		'rodilla',
		'biceps',
		'pierna',
		'cintura',
		'cadera',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function dieta_pacientes()
	{
		return $this->hasMany(DietaPaciente::class, 'antropometria_id');
	}

	public function entrenamiento_pacientes()
	{
		return $this->hasMany(EntrenamientoPaciente::class, 'antropometria_id');
	}
}
