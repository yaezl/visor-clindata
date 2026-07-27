<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dermatologium
 * 
 * @property int $id
 * @property int|null $grafico_id
 * @property int|null $medicion_id
 * @property string $motivo_consulta
 * @property string|null $observacion
 * @property string|null $evolucion
 * @property string|null $tratamientos_previos
 * @property string|null $tratamiento_plan
 * @property string|null $rutina_cuidado_piel
 * @property string|null $observacion_estetica
 * @property string|null $restos_piel_anexos
 * @property string|null $ejercicio
 * @property string|null $nutricion
 * 
 * @property Consultadetalle $consultadetalle
 * @property Medicion|null $medicion
 * @property GraficoDermatologium|null $grafico_dermatologium
 * @property Collection|IndicacionEsteticaDetalle[] $indicacion_estetica_detalles
 * @property Collection|MorfologiaDetalle[] $morfologia_detalles
 * @property Collection|DermatologiaInformedeestudio[] $dermatologia_informedeestudios
 * @property Collection|DermatologiaObjetivo[] $dermatologia_objetivos
 * @property Collection|DermatologiaTopografium[] $dermatologia_topografia
 *
 * @package App\Models
 */
class Dermatologium extends Model
{
	protected $table = 'dermatologia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'grafico_id' => 'int',
		'medicion_id' => 'int'
	];

	protected $fillable = [
		'grafico_id',
		'medicion_id',
		'motivo_consulta',
		'observacion',
		'evolucion',
		'tratamientos_previos',
		'tratamiento_plan',
		'rutina_cuidado_piel',
		'observacion_estetica',
		'restos_piel_anexos',
		'ejercicio',
		'nutricion'
	];

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function medicion()
	{
		return $this->belongsTo(Medicion::class);
	}

	public function grafico_dermatologium()
	{
		return $this->belongsTo(GraficoDermatologium::class, 'grafico_id');
	}

	public function indicacion_estetica_detalles()
	{
		return $this->hasMany(IndicacionEsteticaDetalle::class, 'dermatologia_id');
	}

	public function morfologia_detalles()
	{
		return $this->hasMany(MorfologiaDetalle::class, 'dermatologia_id');
	}

	public function dermatologia_informedeestudios()
	{
		return $this->hasMany(DermatologiaInformedeestudio::class, 'dermatologia_id');
	}

	public function dermatologia_objetivos()
	{
		return $this->hasMany(DermatologiaObjetivo::class, 'dermatologia_id');
	}

	public function dermatologia_topografia()
	{
		return $this->hasMany(DermatologiaTopografium::class, 'dermatologia_id');
	}
}
