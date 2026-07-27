<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DietaPaciente
 * 
 * @property int $id
 * @property int $persona_id
 * @property int|null $antropometria_id
 * @property int $created_by
 * @property int $modified_by
 * @property Carbon $fecha
 * @property string|null $deporte
 * @property string|null $problema_obs_vida
 * @property float|null $horas_sueno
 * @property string|null $calidad_sueno
 * @property string|null $problemas_obs_dieta
 * @property string|null $problemas_obs_digestivo
 * @property string|null $recordatorio_hs
 * @property float|null $ingesta_carbohidrato
 * @property float|null $porcentaje_carbohidrato
 * @property float|null $ingesta_grasa
 * @property float|null $porcentaje_grasa
 * @property float|null $ingesta_proteina
 * @property float|null $porcentaje_proteina
 * @property float|null $ref_grasa_corporal
 * @property float|null $ref_masa_muscular
 * @property float|null $litros_agua
 * @property string|null $indicaciones
 * @property string|null $desayuno
 * @property string|null $primera_colacion
 * @property string|null $almuerzo
 * @property string|null $segunda_colacion
 * @property string|null $cena
 * @property string|null $tercera_colacion
 * @property string|null $porcion_leche
 * @property string|null $porcion_vegsa
 * @property string|null $porcion_vegsb
 * @property string|null $porcion_frutas
 * @property string|null $porcion_pan
 * @property string|null $porcion_carne
 * @property string|null $porcion_grasa
 * @property string|null $porcion_azucar
 * @property string|null $porcion_huevo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property MedicionesAntropometrica|null $mediciones_antropometrica
 * @property Persona $persona
 *
 * @package App\Models
 */
class DietaPaciente extends Model
{
	protected $table = 'dieta_paciente';

	protected $casts = [
		'persona_id' => 'int',
		'antropometria_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'fecha' => 'datetime',
		'horas_sueno' => 'float',
		'ingesta_carbohidrato' => 'float',
		'porcentaje_carbohidrato' => 'float',
		'ingesta_grasa' => 'float',
		'porcentaje_grasa' => 'float',
		'ingesta_proteina' => 'float',
		'porcentaje_proteina' => 'float',
		'ref_grasa_corporal' => 'float',
		'ref_masa_muscular' => 'float',
		'litros_agua' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'persona_id',
		'antropometria_id',
		'created_by',
		'modified_by',
		'fecha',
		'deporte',
		'problema_obs_vida',
		'horas_sueno',
		'calidad_sueno',
		'problemas_obs_dieta',
		'problemas_obs_digestivo',
		'recordatorio_hs',
		'ingesta_carbohidrato',
		'porcentaje_carbohidrato',
		'ingesta_grasa',
		'porcentaje_grasa',
		'ingesta_proteina',
		'porcentaje_proteina',
		'ref_grasa_corporal',
		'ref_masa_muscular',
		'litros_agua',
		'indicaciones',
		'desayuno',
		'primera_colacion',
		'almuerzo',
		'segunda_colacion',
		'cena',
		'tercera_colacion',
		'porcion_leche',
		'porcion_vegsa',
		'porcion_vegsb',
		'porcion_frutas',
		'porcion_pan',
		'porcion_carne',
		'porcion_grasa',
		'porcion_azucar',
		'porcion_huevo',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function mediciones_antropometrica()
	{
		return $this->belongsTo(MedicionesAntropometrica::class, 'antropometria_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
