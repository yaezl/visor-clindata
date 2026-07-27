<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Laboratorio
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $codigoIntegracion
 * @property bool $borrado_logico
 *
 * @package App\Models
 */
class Laboratorio extends Model
{
	protected $table = 'laboratorio';
	public $timestamps = false;

	protected $casts = [
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'codigoIntegracion',
		'borrado_logico'
	];
}
