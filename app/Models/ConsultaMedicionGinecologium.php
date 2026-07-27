<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ConsultaMedicionGinecologium
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $metodo_anticonceptivo_id
 * @property int|null $tratamiento_hormonal_id
 * @property int $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon|null $fecha_ultima_menstruacion
 * @property int|null $ciclo
 * @property int|null $edad_iniciacion_sexual
 * @property int|null $partos
 * @property int|null $abortos
 * @property int|null $pap
 * @property int|null $fuma
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property int|null $gestacion
 * @property int|null $dias_sangrado
 * @property int|null $dias_ciclo
 * @property Carbon|null $fecha_probable_parto
 * @property int|null $cesareas
 * @property Carbon|null $fecha_menarca
 * @property Carbon|null $fecha_mamografia
 * @property int|null $lactancia_meses
 * @property string|null $descripcion_neo
 * 
 * @property Persona|null $persona
 * @property AdminMetodoAnticonceptivo|null $admin_metodo_anticonceptivo
 * @property AdminTratamientoHormonal|null $admin_tratamiento_hormonal
 * @property Usuario|null $usuario
 * @property Collection|Notabasica[] $notabasicas
 *
 * @package App\Models
 */
class ConsultaMedicionGinecologium extends Model
{
	protected $table = 'consulta_medicion_ginecologia';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'metodo_anticonceptivo_id' => 'int',
		'tratamiento_hormonal_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'fecha_ultima_menstruacion' => 'datetime',
		'ciclo' => 'int',
		'edad_iniciacion_sexual' => 'int',
		'partos' => 'int',
		'abortos' => 'int',
		'pap' => 'int',
		'fuma' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'gestacion' => 'int',
		'dias_sangrado' => 'int',
		'dias_ciclo' => 'int',
		'fecha_probable_parto' => 'datetime',
		'cesareas' => 'int',
		'fecha_menarca' => 'datetime',
		'fecha_mamografia' => 'datetime',
		'lactancia_meses' => 'int'
	];

	protected $fillable = [
		'persona_id',
		'metodo_anticonceptivo_id',
		'tratamiento_hormonal_id',
		'creado_por_id',
		'modificado_por_id',
		'fecha_ultima_menstruacion',
		'ciclo',
		'edad_iniciacion_sexual',
		'partos',
		'abortos',
		'pap',
		'fuma',
		'creado_en',
		'modificado_en',
		'gestacion',
		'dias_sangrado',
		'dias_ciclo',
		'fecha_probable_parto',
		'cesareas',
		'fecha_menarca',
		'fecha_mamografia',
		'lactancia_meses',
		'descripcion_neo'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}

	public function admin_metodo_anticonceptivo()
	{
		return $this->belongsTo(AdminMetodoAnticonceptivo::class, 'metodo_anticonceptivo_id');
	}

	public function admin_tratamiento_hormonal()
	{
		return $this->belongsTo(AdminTratamientoHormonal::class, 'tratamiento_hormonal_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function notabasicas()
	{
		return $this->hasMany(Notabasica::class, 'medicion_ginecologia_id');
	}
}
