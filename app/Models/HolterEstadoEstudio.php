<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HolterEstadoEstudio
 * 
 * @property int $id
 * @property string $nombre
 *
 * @package App\Models
 */
class HolterEstadoEstudio extends Model
{
	protected $table = 'holter_estado_estudio';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];
}
