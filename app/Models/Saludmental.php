<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Saludmental
 * 
 * @property int $id
 * @property int|null $derivacion_id
 * @property int|null $tipo_consulta_id
 * @property int|null $area_motivo_id
 * @property string|null $antecedentes
 * @property string|null $indicaciones_terapeuticas
 * @property string|null $tiempo_episodio
 * @property string|null $tiempo_enfermedad
 * @property string|null $examen_clinico
 * @property string|null $anamnesis
 * @property string|null $dinamica_familiar
 * @property string|null $evaluacion_psico
 * 
 * @property DerivacionSaludmental|null $derivacion_saludmental
 * @property TipoConsultaSaludmental|null $tipo_consulta_saludmental
 * @property AreaMotivoSaludmental|null $area_motivo_saludmental
 * @property Consultadetalle $consultadetalle
 * @property Collection|Informedeestudio[] $informedeestudios
 *
 * @package App\Models
 */
class Saludmental extends Model
{
	protected $table = 'saludmental';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'derivacion_id' => 'int',
		'tipo_consulta_id' => 'int',
		'area_motivo_id' => 'int'
	];

	protected $fillable = [
		'derivacion_id',
		'tipo_consulta_id',
		'area_motivo_id',
		'antecedentes',
		'indicaciones_terapeuticas',
		'tiempo_episodio',
		'tiempo_enfermedad',
		'examen_clinico',
		'anamnesis',
		'dinamica_familiar',
		'evaluacion_psico'
	];

	public function derivacion_saludmental()
	{
		return $this->belongsTo(DerivacionSaludmental::class, 'derivacion_id');
	}

	public function tipo_consulta_saludmental()
	{
		return $this->belongsTo(TipoConsultaSaludmental::class, 'tipo_consulta_id');
	}

	public function area_motivo_saludmental()
	{
		return $this->belongsTo(AreaMotivoSaludmental::class, 'area_motivo_id');
	}

	public function consultadetalle()
	{
		return $this->belongsTo(Consultadetalle::class, 'id');
	}

	public function informedeestudios()
	{
		return $this->belongsToMany(Informedeestudio::class, 'saludmental_informedeestudio');
	}
}
