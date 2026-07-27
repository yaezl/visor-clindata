<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Procedencium
 * 
 * @property int $id
 * @property string $nombre
 * @property bool $borrado_logico
 * @property string|null $codigoIntegracion
 * 
 * @property Collection|Lote[] $lotes
 * @property Collection|Recepcionalmacen[] $recepcionalmacens
 *
 * @package App\Models
 */
class Procedencium extends Model
{
	protected $table = 'procedencia';
	public $timestamps = false;

	protected $casts = [
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'borrado_logico',
		'codigoIntegracion'
	];

	public function lotes()
	{
		return $this->hasMany(Lote::class, 'procedencia_id');
	}

	public function recepcionalmacens()
	{
		return $this->hasMany(Recepcionalmacen::class, 'procedencia_id');
	}
}
