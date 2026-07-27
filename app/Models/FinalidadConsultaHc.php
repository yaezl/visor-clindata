<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FinalidadConsultaHc
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|Consultadetalle[] $consultadetalles
 *
 * @package App\Models
 */
class FinalidadConsultaHc extends Model
{
	protected $table = 'finalidad_consulta_hc';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function consultadetalles()
	{
		return $this->hasMany(Consultadetalle::class, 'finalidad_consulta_id');
	}
}
