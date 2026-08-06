<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionParteAnestesico
 * 
 * @property int $id
 * @property int|null $parte_quirurgico_id
 * @property int|null $articulo_tipopresentacion_id
 * @property int|null $proteccion_ojos
 * @property int|null $proteccion_miembros
 * @property string|null $canalizacion
 * @property string $f_cardiaca
 * @property string $preoxigenacion
 * @property string|null $ta_previa
 * @property string|null $monitores_empleados
 * @property string|null $fenomenos_dinamicos
 * @property string|null $metodo_anestesico
 * @property string|null $recuperacion
 * @property int|null $tipo_anestesia
 * @property string|null $proced_anest
 * @property string|null $paciente_estado_durante
 * @property string|null $paciente_estado_fin
 * @property string|null $antecedentes
 * @property string|null $resumen_enfermedad
 * @property string|null $examen_fisico
 * @property string|null $conclusiones
 * @property string|null $balance
 * @property string|null $balance_post
 * @property string|null $ingreso
 * @property string|null $egreso
 * @property string|null $hora_inicio
 * @property string|null $hora_fin
 * @property int|null $creado_por_id
 * @property Carbon|null $created_at
 * 
 * @property InternacionParteQuirurgico|null $internacion_parte_quirurgico
 * @property Usuario|null $usuario
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Collection|InternacionMedicamentoPa[] $internacion_medicamento_pas
 * @property Collection|InternacionRecordAnestesico[] $internacion_record_anestesicos
 *
 * @package App\Models
 */
class InternacionParteAnestesico extends Model
{
	protected $table = 'internacion_parte_anestesico';
	public $timestamps = false;

	protected $casts = [
		'parte_quirurgico_id' => 'int',
		'articulo_tipopresentacion_id' => 'int',
		'proteccion_ojos' => 'int',
		'proteccion_miembros' => 'int',
		'tipo_anestesia' => 'int',
		'creado_por_id' => 'int'
	];

	protected $fillable = [
		'parte_quirurgico_id',
		'articulo_tipopresentacion_id',
		'proteccion_ojos',
		'proteccion_miembros',
		'canalizacion',
		'f_cardiaca',
		'preoxigenacion',
		'ta_previa',
		'monitores_empleados',
		'fenomenos_dinamicos',
		'metodo_anestesico',
		'recuperacion',
		'tipo_anestesia',
		'proced_anest',
		'paciente_estado_durante',
		'paciente_estado_fin',
		'antecedentes',
		'resumen_enfermedad',
		'examen_fisico',
		'conclusiones',
		'balance',
		'balance_post',
		'ingreso',
		'egreso',
		'hora_inicio',
		'hora_fin',
		'creado_por_id'
	];

	public function internacion_parte_quirurgico()
	{
		return $this->belongsTo(InternacionParteQuirurgico::class, 'parte_quirurgico_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class);
	}

	public function internacion_medicamento_pas()
	{
		return $this->hasMany(InternacionMedicamentoPa::class, 'parteanestesico_id');
	}

	public function internacion_record_anestesicos()
	{
		return $this->hasMany(InternacionRecordAnestesico::class, 'parte_anestesico');
	}
}
