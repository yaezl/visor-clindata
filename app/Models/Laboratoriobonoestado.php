<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Laboratoriobonoestado
 * 
 * @property int $id
 * @property int $idBonoItem
 * @property int $idEstadoLaboratorio
 * @property int|null $usuarioGenero
 *
 * @package App\Models
 */
class Laboratoriobonoestado extends Model
{
	protected $table = 'laboratoriobonoestado';
	public $timestamps = false;

	protected $casts = [
		'idBonoItem' => 'int',
		'idEstadoLaboratorio' => 'int',
		'usuarioGenero' => 'int'
	];

	protected $fillable = [
		'idBonoItem',
		'idEstadoLaboratorio',
		'usuarioGenero'
	];
}
