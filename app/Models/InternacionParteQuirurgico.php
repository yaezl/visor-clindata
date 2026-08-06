<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionParteQuirurgico
 * 
 * @property int $id
 * @property int|null $persona_internacion_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string|null $observaciones
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $fecha_evento
 * @property bool $es_urgencia
 * @property string $duracion
 * @property string $radioscopia_min
 * @property bool $congelacion
 * @property bool $patologia_dif
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property string|null $informe
 * @property bool $parteFinalizado
 * 
 * @property InternacionPersona|null $internacion_persona
 * @property Usuario|null $usuario
 * @property Collection|HojaConsumo[] $hoja_consumos
 * @property Collection|InternacionDiagnosticoPq[] $internacion_diagnostico_pqs
 * @property Collection|InternacionEstudioPq[] $internacion_estudio_pqs
 * @property InternacionParteAnestesico|null $internacion_parte_anestesico
 * @property InternacionPartePreanestesico|null $internacion_parte_preanestesico
 * @property Collection|InternacionProfesionalPq[] $internacion_profesional_pqs
 *
 * @package App\Models
 */
class InternacionParteQuirurgico extends Model
{
	protected $table = 'internacion_parte_quirurgico';
	public $timestamps = false;

	protected $casts = [
		'persona_internacion_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'fecha_evento' => 'datetime',
		'es_urgencia' => 'bool',
		'congelacion' => 'bool',
		'patologia_dif' => 'bool',
		'parteFinalizado' => 'bool'
	];

	protected $fillable = [
		'persona_internacion_id',
		'creado_por_id',
		'modificado_por_id',
		'observaciones',
		'creado_en',
		'modificado_en',
		'fecha_evento',
		'es_urgencia',
		'duracion',
		'radioscopia_min',
		'congelacion',
		'patologia_dif',
		'hora_inicio',
		'hora_fin',
		'informe',
		'parteFinalizado'
	];

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function hoja_consumos()
	{
		return $this->hasMany(HojaConsumo::class, 'parte_quirurgico_id');
	}

	public function internacion_diagnostico_pqs()
	{
		return $this->hasMany(InternacionDiagnosticoPq::class, 'parte_id');
	}

	public function internacion_estudio_pqs()
	{
		return $this->hasMany(InternacionEstudioPq::class, 'parte_id');
	}

	public function internacion_parte_anestesico()
	{
		return $this->hasOne(InternacionParteAnestesico::class, 'parte_quirurgico_id');
	}

	public function internacion_parte_preanestesico()
	{
		return $this->hasOne(InternacionPartePreanestesico::class, 'parte_quirurgico_id');
	}

	public function internacion_profesional_pqs()
	{
		return $this->hasMany(InternacionProfesionalPq::class, 'parte_id');
	}
}
