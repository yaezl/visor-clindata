<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticuloTipoDetalle
 * 
 * @property int $id
 * @property int|null $articulo_id
 * @property int|null $tiposArticulo_id
 * 
 * @property Articulo|null $articulo
 * @property TipoArticulo|null $tipo_articulo
 *
 * @package App\Models
 */
class ArticuloTipoDetalle extends Model
{
	protected $table = 'ArticuloTipoDetalle';
	public $timestamps = false;

	protected $casts = [
		'articulo_id' => 'int',
		'tiposArticulo_id' => 'int'
	];

	protected $fillable = [
		'articulo_id',
		'tiposArticulo_id'
	];

	public function articulo()
	{
		return $this->belongsTo(Articulo::class);
	}

	public function tipo_articulo()
	{
		return $this->belongsTo(TipoArticulo::class, 'tiposArticulo_id');
	}
}
