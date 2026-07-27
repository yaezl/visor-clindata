<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estadoodontologium
 * 
 * @property int $id
 * @property int $codigo_estado
 * @property string $nombre_estado
 *
 * @package App\Models
 */
class Estadoodontologium extends Model
{
	protected $table = 'estadoodontologia';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'codigo_estado' => 'int'
	];

	protected $fillable = [
		'id',
		'codigo_estado',
		'nombre_estado'
	];
}
