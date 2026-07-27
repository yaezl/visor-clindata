<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductoSited
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property string|null $codigoIafa
 * 
 * @property Collection|ModalidadCoberturaSited[] $modalidad_cobertura_siteds
 *
 * @package App\Models
 */
class ProductoSited extends Model
{
	protected $table = 'producto_siteds';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo',
		'codigoIafa'
	];

	public function modalidad_cobertura_siteds()
	{
		return $this->hasMany(ModalidadCoberturaSited::class, 'producto');
	}
}
