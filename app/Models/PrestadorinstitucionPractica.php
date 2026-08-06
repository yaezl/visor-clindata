<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PrestadorinstitucionPractica
 * 
 * @property int $prestadorinstitucion_id
 * @property int $practica_id
 * 
 * @property Estudio $estudio
 * @property PrestadorInstitucion $prestador_institucion
 *
 * @package App\Models
 */
class PrestadorinstitucionPractica extends Model
{
	protected $table = 'prestadorinstitucion_practica';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'prestadorinstitucion_id' => 'int',
		'practica_id' => 'int'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class, 'practica_id');
	}

	public function prestador_institucion()
	{
		return $this->belongsTo(PrestadorInstitucion::class, 'prestadorinstitucion_id');
	}
}
