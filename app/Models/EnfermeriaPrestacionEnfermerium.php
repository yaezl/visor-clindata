<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EnfermeriaPrestacionEnfermerium
 * 
 * @property int $enfermeria_id
 * @property int $prestacion_enfermeria_id
 * 
 * @property Enfermerium $enfermerium
 * @property PrestacionEnfermerium $prestacion_enfermerium
 *
 * @package App\Models
 */
class EnfermeriaPrestacionEnfermerium extends Model
{
	protected $table = 'enfermeria_prestacion_enfermeria';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'enfermeria_id' => 'int',
		'prestacion_enfermeria_id' => 'int'
	];

	public function enfermerium()
	{
		return $this->belongsTo(Enfermerium::class, 'enfermeria_id');
	}

	public function prestacion_enfermerium()
	{
		return $this->belongsTo(PrestacionEnfermerium::class, 'prestacion_enfermeria_id');
	}
}
