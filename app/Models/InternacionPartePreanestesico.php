<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionPartePreanestesico
 * 
 * @property int $id
 * @property int $parte_quirurgico_id
 * @property int|null $creado_por_id
 * @property Carbon|null $created_at
 * @property string $antecedentes_medicos
 * @property string $resumen_enfermedad_actual
 * @property string|null $alergias
 * @property string|null $morbilidades_adjuntas
 * @property string|null $medicamentos
 * @property string|null $riesgo_respiratorio
 * @property string $indice_asa
 * @property string|null $indice_mallampati
 * @property string $tipo_anestesia_prevista
 * @property string|null $conclusiones
 * 
 * @property InternacionParteQuirurgico $internacion_parte_quirurgico
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class InternacionPartePreanestesico extends Model
{
	protected $table = 'internacion_parte_preanestesico';
	public $timestamps = false;

	protected $casts = [
		'parte_quirurgico_id' => 'int',
		'creado_por_id' => 'int'
	];

	protected $fillable = [
		'parte_quirurgico_id',
		'creado_por_id',
		'antecedentes_medicos',
		'resumen_enfermedad_actual',
		'alergias',
		'morbilidades_adjuntas',
		'medicamentos',
		'riesgo_respiratorio',
		'indice_asa',
		'indice_mallampati',
		'tipo_anestesia_prevista',
		'conclusiones'
	];

	public function internacion_parte_quirurgico()
	{
		return $this->belongsTo(InternacionParteQuirurgico::class, 'parte_quirurgico_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}
}
