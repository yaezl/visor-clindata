<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Capituloodontoestudiodibujo
 * 
 * @property int $id
 * @property int|null $tipo_id
 * @property int|null $capituloestudio_id
 * @property int|null $imagen_id
 * 
 * @property Odontotipodibujo|null $odontotipodibujo
 * @property CapituloodontologiaEstudio|null $capituloodontologia_estudio
 * @property Odontoimagen|null $odontoimagen
 *
 * @package App\Models
 */
class Capituloodontoestudiodibujo extends Model
{
	protected $table = 'capituloodontoestudiodibujo';
	public $timestamps = false;

	protected $casts = [
		'tipo_id' => 'int',
		'capituloestudio_id' => 'int',
		'imagen_id' => 'int'
	];

	protected $fillable = [
		'tipo_id',
		'capituloestudio_id',
		'imagen_id'
	];

	public function odontotipodibujo()
	{
		return $this->belongsTo(Odontotipodibujo::class, 'tipo_id');
	}

	public function capituloodontologia_estudio()
	{
		return $this->belongsTo(CapituloodontologiaEstudio::class, 'capituloestudio_id');
	}

	public function odontoimagen()
	{
		return $this->belongsTo(Odontoimagen::class, 'imagen_id');
	}
}
