<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Antecedentenutricionalpediatrico
 * 
 * @property int $id
 * @property int|null $persona_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property bool|null $lactancia_materna
 * @property int|null $duracion_lactancia
 * @property int|null $edad_ablactacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 * @property Persona|null $persona
 *
 * @package App\Models
 */
class Antecedentenutricionalpediatrico extends Model
{
	protected $table = 'antecedentenutricionalpediatrico';
	public $timestamps = false;

	protected $casts = [
		'persona_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'lactancia_materna' => 'bool',
		'duracion_lactancia' => 'int',
		'edad_ablactacion' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'persona_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'lactancia_materna',
		'duracion_lactancia',
		'edad_ablactacion',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}

	public function persona()
	{
		return $this->belongsTo(Persona::class);
	}
}
