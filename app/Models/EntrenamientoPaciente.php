<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EntrenamientoPaciente
 * 
 * @property int $id
 * @property int $persona_id
 * @property int|null $antropometria_id
 * @property int $created_by
 * @property int $modified_by
 * @property Carbon $fecha
 * @property string|null $deporte
 * @property string|null $frecuencia_semanal
 * @property string|null $sesiones_semanales
 * @property string|null $duracion
 * @property string|null $intensidad
 * @property float|null $t_ent_max
 * @property float|null $t_ent_anaerobico
 * @property float|null $t_ent_equilibrio
 * @property float|null $t_ent_aerobico
 * @property float|null $t_act_moderada
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
class EntrenamientoPaciente extends Model
{
	protected $table = 'entrenamiento_paciente';

	protected $casts = [
		'persona_id' => 'int',
		'antropometria_id' => 'int',
		'created_by' => 'int',
		'modified_by' => 'int',
		'fecha' => 'datetime',
		't_ent_max' => 'float',
		't_ent_anaerobico' => 'float',
		't_ent_equilibrio' => 'float',
		't_ent_aerobico' => 'float',
		't_act_moderada' => 'float',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'persona_id',
		'antropometria_id',
		'created_by',
		'modified_by',
		'fecha',
		'deporte',
		'frecuencia_semanal',
		'sesiones_semanales',
		'duracion',
		'intensidad',
		't_ent_max',
		't_ent_anaerobico',
		't_ent_equilibrio',
		't_ent_aerobico',
		't_act_moderada',
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
