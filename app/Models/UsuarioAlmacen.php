<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioAlmacen
 * 
 * @property int $id
 * @property int|null $institucion_id
 * @property int|null $usuario_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $nombre
 * @property string|null $observacion
 * @property bool $pedirProveedor
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property Collection|Almacen[] $almacens
 * @property Collection|StkAlmacen[] $stk_almacens
 *
 * @package App\Models
 */
class UsuarioAlmacen extends Model
{
	protected $table = 'usuario_almacen';
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'usuario_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'pedirProveedor' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'institucion_id',
		'usuario_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'nombre',
		'observacion',
		'pedirProveedor',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function almacens()
	{
		return $this->hasMany(Almacen::class, 'dar_stock');
	}

	public function stk_almacens()
	{
		return $this->hasMany(StkAlmacen::class, 'dar_stock');
	}
}
