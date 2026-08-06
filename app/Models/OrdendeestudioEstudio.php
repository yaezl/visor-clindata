<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdendeestudioEstudio
 * 
 * @property int|null $ordendeestudio_id
 * @property int|null $estudio_id
 * @property int $id
 * @property string|null $observacion
 * @property int|null $turno_id
 * 
 * @property Estudio|null $estudio
 * @property Ordendeestudio|null $ordendeestudio
 *
 * @package App\Models
 */
class OrdendeestudioEstudio extends Model
{
	protected $table = 'ordendeestudio_estudio';
	public $timestamps = false;

	protected $casts = [
		'ordendeestudio_id' => 'int',
		'estudio_id' => 'int',
		'turno_id' => 'int'
	];

	protected $fillable = [
		'ordendeestudio_id',
		'estudio_id',
		'observacion',
		'turno_id'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function ordendeestudio()
	{
		return $this->belongsTo(Ordendeestudio::class);
	}
}
