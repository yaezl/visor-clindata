<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionRecordAnestesico
 * 
 * @property int $id
 * @property float|null $lm
 * @property float|null $tas
 * @property float|null $tad
 * @property float|null $tam
 * @property float|null $sat_oxigeno
 * @property float|null $dioxi_carbono
 * @property float|null $pres_venosa
 * @property float|null $diuresis
 * @property float|null $sevofluorano
 * @property float|null $isofluorano
 * @property float|null $temp_corporal
 * @property float|null $sat_venosa
 * @property Carbon $creado_en
 * @property int|null $parte_anestesico
 * @property int|null $creadopor_id
 * @property int|null $persona_internacion_id
 * 
 * @property InternacionParteAnestesico|null $internacion_parte_anestesico
 * @property InternacionPersona|null $internacion_persona
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class InternacionRecordAnestesico extends Model
{
	protected $table = 'internacion_record_anestesico';
	public $timestamps = false;

	protected $casts = [
		'lm' => 'float',
		'tas' => 'float',
		'tad' => 'float',
		'tam' => 'float',
		'sat_oxigeno' => 'float',
		'dioxi_carbono' => 'float',
		'pres_venosa' => 'float',
		'diuresis' => 'float',
		'sevofluorano' => 'float',
		'isofluorano' => 'float',
		'temp_corporal' => 'float',
		'sat_venosa' => 'float',
		'creado_en' => 'datetime',
		'parte_anestesico' => 'int',
		'creadopor_id' => 'int',
		'persona_internacion_id' => 'int'
	];

	protected $fillable = [
		'lm',
		'tas',
		'tad',
		'tam',
		'sat_oxigeno',
		'dioxi_carbono',
		'pres_venosa',
		'diuresis',
		'sevofluorano',
		'isofluorano',
		'temp_corporal',
		'sat_venosa',
		'creado_en',
		'parte_anestesico',
		'creadopor_id',
		'persona_internacion_id'
	];

	public function internacion_parte_anestesico()
	{
		return $this->belongsTo(InternacionParteAnestesico::class, 'parte_anestesico');
	}

	public function internacion_persona()
	{
		return $this->belongsTo(InternacionPersona::class, 'persona_internacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}
}
