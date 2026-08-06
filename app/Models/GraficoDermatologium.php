<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GraficoDermatologium
 * 
 * @property int $id
 * @property string $deshidratacion_paciente
 * @property string $poros_paciente
 * @property string $anormalidades_piel_paciente
 * @property string $manchas_tono_paciente
 * @property string $vasos_visibles_paciente
 * @property string $estaticas_paciente
 * @property string $dinamicas_paciente
 * @property string $perdida_volumen_paciente
 * @property string $flacidez_paciente
 * @property string $deshidratacion_profesional
 * @property string $poros_profesional
 * @property string $anormalidades_piel_profesional
 * @property string $manchas_tono_profesional
 * @property string $vasos_visibles_profesional
 * @property string $estaticas_profesional
 * @property string $dinamicas_profesional
 * @property string $perdida_volumen_profesional
 * @property string $flacidez_profesional
 * 
 * @property Dermatologium|null $dermatologium
 *
 * @package App\Models
 */
class GraficoDermatologium extends Model
{
	protected $table = 'grafico_dermatologia';
	public $timestamps = false;

	protected $fillable = [
		'deshidratacion_paciente',
		'poros_paciente',
		'anormalidades_piel_paciente',
		'manchas_tono_paciente',
		'vasos_visibles_paciente',
		'estaticas_paciente',
		'dinamicas_paciente',
		'perdida_volumen_paciente',
		'flacidez_paciente',
		'deshidratacion_profesional',
		'poros_profesional',
		'anormalidades_piel_profesional',
		'manchas_tono_profesional',
		'vasos_visibles_profesional',
		'estaticas_profesional',
		'dinamicas_profesional',
		'perdida_volumen_profesional',
		'flacidez_profesional'
	];

	public function dermatologium()
	{
		return $this->hasOne(Dermatologium::class, 'grafico_id');
	}
}
