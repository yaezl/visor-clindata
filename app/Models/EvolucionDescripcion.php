<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EvolucionDescripcion
 * 
 * @property int $id
 * @property int|null $hoja_evolucion_id
 * @property int|null $creado_por_id
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property int|null $especialidad_id
 * 
 * @property Especialidad|null $especialidad
 * @property InternacionHojaEvolucion|null $internacion_hoja_evolucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class EvolucionDescripcion extends Model
{
	protected $table = 'evolucion_descripcion';
	public $timestamps = false;

	protected $casts = [
		'hoja_evolucion_id' => 'int',
		'creado_por_id' => 'int',
		'creado_en' => 'datetime',
		'especialidad_id' => 'int'
	];

	protected $fillable = [
		'hoja_evolucion_id',
		'creado_por_id',
		'descripcion',
		'creado_en',
		'especialidad_id'
	];

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function internacion_hoja_evolucion()
	{
		return $this->belongsTo(InternacionHojaEvolucion::class, 'hoja_evolucion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}
}
