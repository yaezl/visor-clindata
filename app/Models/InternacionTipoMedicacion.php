<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionTipoMedicacion
 * 
 * @property int $id
 * @property string $codigo
 * @property string $descripcion
 * 
 * @property Collection|InternacionHojaEnfermeriaIndicacion[] $internacion_hoja_enfermeria_indicacions
 * @property Collection|InternacionHojaEnfermeriaMedicacion[] $internacion_hoja_enfermeria_medicacions
 *
 * @package App\Models
 */
class InternacionTipoMedicacion extends Model
{
	protected $table = 'internacion_tipo_medicacion';
	public $timestamps = false;

	protected $fillable = [
		'codigo',
		'descripcion'
	];

	public function internacion_hoja_enfermeria_indicacions()
	{
		return $this->hasMany(InternacionHojaEnfermeriaIndicacion::class, 'tipo_id');
	}

	public function internacion_hoja_enfermeria_medicacions()
	{
		return $this->hasMany(InternacionHojaEnfermeriaMedicacion::class, 'tipo_id');
	}
}
