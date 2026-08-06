<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estudiocomplementario
 * 
 * @property int $id
 * @property int|null $estudio_id
 * @property int|null $consulta_id
 * @property string|null $observacion
 * 
 * @property Estudio|null $estudio
 * @property Consultum|null $consultum
 *
 * @package App\Models
 */
class Estudiocomplementario extends Model
{
	protected $table = 'estudiocomplementario';
	public $timestamps = false;

	protected $casts = [
		'estudio_id' => 'int',
		'consulta_id' => 'int'
	];

	protected $fillable = [
		'estudio_id',
		'consulta_id',
		'observacion'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function consultum()
	{
		return $this->belongsTo(Consultum::class, 'consulta_id');
	}
}
