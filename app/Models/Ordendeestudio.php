<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ordendeestudio
 * 
 * @property int $id
 * @property string|null $observacion
 * @property string|null $datos
 * @property int|null $archivo_id
 * @property int|null $diagnostico_id
 * 
 * @property Indicacion $indicacion
 * @property Collection|Informedeestudio[] $informedeestudios
 * @property Collection|Estudio[] $estudios
 *
 * @package App\Models
 */
class Ordendeestudio extends Model
{
	protected $table = 'ordendeestudio';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'archivo_id' => 'int',
		'diagnostico_id' => 'int'
	];

	protected $fillable = [
		'observacion',
		'datos',
		'archivo_id',
		'diagnostico_id'
	];

	public function indicacion()
	{
		return $this->belongsTo(Indicacion::class, 'id');
	}

	public function informedeestudios()
	{
		return $this->hasMany(Informedeestudio::class);
	}

	public function estudios()
	{
		return $this->belongsToMany(Estudio::class, 'ordendeestudio_estudio')
					->withPivot('id', 'observacion', 'turno_id');
	}
}
