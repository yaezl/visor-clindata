<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Formadepago
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * 
 * @property Collection|Factura[] $facturas
 *
 * @package App\Models
 */
class Formadepago extends Model
{
	protected $table = 'formadepago';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function facturas()
	{
		return $this->hasMany(Factura::class, 'formapago_id');
	}
}
