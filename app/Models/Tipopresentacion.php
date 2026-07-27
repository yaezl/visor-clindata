<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipopresentacion
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|Articulo[] $articulos
 *
 * @package App\Models
 */
class Tipopresentacion extends Model
{
	protected $table = 'tipopresentacion';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function articulos()
	{
		return $this->belongsToMany(Articulo::class)
					->withPivot('id', 'tipounidadmedida_id', 'dosis', 'creado_por_id', 'modificado_por_id', 'eliminado_por_id', 'creado_en', 'modificado_en', 'borrado_en', 'borrado_logico', 'precio', 'codigo', 'troquel', 'codigo_barras', 'laboratorio', 'nombre_comercial', 'idUbicacionAlmacen');
	}
}
