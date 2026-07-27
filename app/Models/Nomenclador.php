<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Nomenclador
 * 
 * @property int $id
 * @property int|null $convenio_id
 * @property int|null $prestacion_raiz_id
 * 
 * @property Convenio|null $convenio
 * @property Prestacion|null $prestacion
 * @property Collection|Cotizacion[] $cotizacions
 * @property Collection|Regla[] $reglas
 *
 * @package App\Models
 */
class Nomenclador extends Model
{
	protected $table = 'nomenclador';
	public $timestamps = false;

	protected $casts = [
		'convenio_id' => 'int',
		'prestacion_raiz_id' => 'int'
	];

	protected $fillable = [
		'convenio_id',
		'prestacion_raiz_id'
	];

	public function convenio()
	{
		return $this->belongsTo(Convenio::class);
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class, 'prestacion_raiz_id');
	}

	public function cotizacions()
	{
		return $this->hasMany(Cotizacion::class);
	}

	public function reglas()
	{
		return $this->hasMany(Regla::class);
	}
}
