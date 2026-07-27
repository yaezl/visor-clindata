<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AtpAlmacen
 * 
 * @property int $atp_id
 * @property int $almacen_id
 * 
 * @property ArticuloTipopresentacion $articulo_tipopresentacion
 * @property Almacen $almacen
 *
 * @package App\Models
 */
class AtpAlmacen extends Model
{
	protected $table = 'atp_almacen';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'atp_id' => 'int',
		'almacen_id' => 'int'
	];

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}
}
