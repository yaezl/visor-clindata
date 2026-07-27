<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoArticulo
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $nombre
 * @property string|null $codigo
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|ArticuloTipoDetalle[] $articulo_tipo_detalles
 *
 * @package App\Models
 */
class TipoArticulo extends Model
{
	protected $table = 'tipo_articulo';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'nombre',
		'codigo',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}

	public function articulo_tipo_detalles()
	{
		return $this->hasMany(ArticuloTipoDetalle::class, 'tiposArticulo_id');
	}
}
