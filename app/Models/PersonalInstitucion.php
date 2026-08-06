<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PersonalInstitucion
 * 
 * @property int $personal_id
 * @property int $institucion_id
 * 
 * @property Personal $personal
 * @property Institucion $institucion
 *
 * @package App\Models
 */
class PersonalInstitucion extends Model
{
	protected $table = 'personal_institucion';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'personal_id' => 'int',
		'institucion_id' => 'int'
	];

	public function personal()
	{
		return $this->belongsTo(Personal::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
