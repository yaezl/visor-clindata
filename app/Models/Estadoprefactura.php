<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estadoprefactura
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * 
 * @property Collection|Prefactura[] $prefacturas
 *
 * @package App\Models
 */
class Estadoprefactura extends Model
{
	protected $table = 'estadoprefactura';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function prefacturas()
	{
		return $this->hasMany(Prefactura::class, 'estado_id');
	}
}
