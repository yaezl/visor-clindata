<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Capituloodontodibujo
 * 
 * @property int $id
 * @property int|null $tipo_id
 * @property int|null $capitulo_id
 * @property int|null $imagen_id
 * 
 * @property Odontotipodibujo|null $odontotipodibujo
 * @property Capituloodontologium|null $capituloodontologium
 * @property Odontoimagen|null $odontoimagen
 *
 * @package App\Models
 */
class Capituloodontodibujo extends Model
{
	protected $table = 'capituloodontodibujo';
	public $timestamps = false;

	protected $casts = [
		'tipo_id' => 'int',
		'capitulo_id' => 'int',
		'imagen_id' => 'int'
	];

	protected $fillable = [
		'tipo_id',
		'capitulo_id',
		'imagen_id'
	];

	public function odontotipodibujo()
	{
		return $this->belongsTo(Odontotipodibujo::class, 'tipo_id');
	}

	public function capituloodontologium()
	{
		return $this->belongsTo(Capituloodontologium::class, 'capitulo_id');
	}

	public function odontoimagen()
	{
		return $this->belongsTo(Odontoimagen::class, 'imagen_id');
	}
}
