<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonalEspecialidad
 * 
 * @property int $personal_id
 * @property int $especialidad_id
 * 
 * @property Especialidad $especialidad
 * @property Personal $personal
 *
 * @package App\Models
 */
class PersonalEspecialidad extends Model
{
	protected $table = 'personal_especialidad';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'personal_id' => 'int',
		'especialidad_id' => 'int'
	];

	public function especialidad()
	{
		return $this->belongsTo(Especialidad::class);
	}

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}
}
