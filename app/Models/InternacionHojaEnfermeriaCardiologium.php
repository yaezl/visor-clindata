<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InternacionHojaEnfermeriaCardiologium
 * 
 * @property int $id
 * @property string $descripcion
 * @property string $codigo
 * 
 * @property Collection|InternacionHojaEnfermeriaControle[] $internacion_hoja_enfermeria_controles
 *
 * @package App\Models
 */
class InternacionHojaEnfermeriaCardiologium extends Model
{
	protected $table = 'internacion_hoja_enfermeria_cardiologia';
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'codigo'
	];

	public function internacion_hoja_enfermeria_controles()
	{
		return $this->hasMany(InternacionHojaEnfermeriaControle::class, 'cardiologia_id');
	}
}
