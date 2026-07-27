<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaControle
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $persona_internacion_id
 * @property int|null $cardiologia_id
 * @property float|null $tension_minima
 * @property float|null $tension_media
 * @property float|null $tension_maxima
 * @property float|null $fc
 * @property float|null $fr
 * @property float|null $saturacion
 * @property float|null $pvc
 * @property float|null $pic
 * @property float|null $peso
 * @property float|null $tempaxil
 * @property float|null $temprec
 * @property bool $cardio
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property float|null $hgt
 * @property string $hora_med
 * 
 * @property InternacionHojaEnfermeriaCardiologium|null $internacion_hoja_enfermeria_cardiologium
 * @property InternacionPersona|null $internacion_persona
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaControle extends Model
{
	protected $table = 'internacion_hoja_enfermeria_controles';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'persona_internacion_id' => 'int',
		'cardiologia_id' => 'int',
		'tension_minima' => 'float',
		'tension_media' => 'float',
		'tension_maxima' => 'float',
		'fc' => 'float',
		'fr' => 'float',
		'saturacion' => 'float',
		'pvc' => 'float',
		'pic' => 'float',
		'peso' => 'float',
		'tempaxil' => 'float',
		'temprec' => 'float',
		'cardio' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'hgt' => 'float'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'persona_internacion_id',
		'cardiologia_id',
		'tension_minima',
		'tension_media',
		'tension_maxima',
		'fc',
		'fr',
		'saturacion',
		'pvc',
		'pic',
		'peso',
		'tempaxil',
		'temprec',
		'cardio',
		'creado_en',
		'modificado_en',
		'hgt',
		'hora_med'
	];

	public function internacion_hoja_enfermeria_cardiologium()
	{
		return $this->belongsTo(InternacionHojaEnfermeriaCardiologium::class, 'cardiologia_id');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}
}
