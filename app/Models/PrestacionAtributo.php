<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PrestacionAtributo
 * 
 * @property int $id
 * @property int|null $prestacion_id
 * @property string $codigoCuenta
 * @property string $codigoCentroCosto
 * @property string $lineaServicio
 * @property string $lineaNegocio
 * @property string $undidadServicio
 * 
 * @property Prestacion|null $prestacion
 *
 * @package App\Models
 */
class PrestacionAtributo extends Model
{
	protected $table = 'prestacion_atributos';
	public $timestamps = false;

	protected $casts = [
		'prestacion_id' => 'int'
	];

	protected $fillable = [
		'prestacion_id',
		'codigoCuenta',
		'codigoCentroCosto',
		'lineaServicio',
		'lineaNegocio',
		'undidadServicio'
	];

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}
}
