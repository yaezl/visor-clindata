<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaNota
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $persona_internacion_id
 * @property string $nota
 * @property Carbon $fecha
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * 
 * @property Usuario|null $usuario
 * @property InternacionPersona|null $internacion_persona
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaNota extends Model
{
	protected $table = 'internacion_hoja_enfermeria_notas';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'persona_internacion_id',
		'nota',
		'fecha',
		'creado_en',
		'modificado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}
}
