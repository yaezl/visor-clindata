<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaValoracionDolor
 * 
 * @property int $id
 * @property Carbon $creado_en
 * @property int|null $valoracionDolor
 * @property int|null $creado_por_id
 * @property int|null $persona_internacion_id
 * 
 * @property InternacionPersona|null $internacion_persona
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaValoracionDolor extends Model
{
	protected $table = 'internacion_hoja_enfermeria_valoracion_dolor';
	public $timestamps = false;

	protected $casts = [
		'creado_en' => 'datetime',
		'valoracionDolor' => 'int',
		'creado_por_id' => 'int',
		'persona_internacion_id' => 'int'
	];

	protected $fillable = [
		'creado_en',
		'valoracionDolor',
		'creado_por_id',
		'persona_internacion_id'
	];

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}
}
