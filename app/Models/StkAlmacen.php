<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkAlmacen
 * 
 * @property int $id
 * @property int|null $ver_stock
 * @property int|null $pedir_stock
 * @property int|null $dar_stock
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property string $nombre
 * @property string|null $codigo
 * @property string|null $observaciones
 * @property bool $es_farmacia
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $activo
 * 
 * @property UsuarioAlmacen|null $usuario_almacen
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class StkAlmacen extends Model
{
	protected $table = 'stk_almacen';
	public $timestamps = false;

	protected $casts = [
		'ver_stock' => 'int',
		'pedir_stock' => 'int',
		'dar_stock' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'es_farmacia' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'activo' => 'bool'
	];

	protected $fillable = [
		'ver_stock',
		'pedir_stock',
		'dar_stock',
		'creado_por_id',
		'modificado_por_id',
		'nombre',
		'codigo',
		'observaciones',
		'es_farmacia',
		'creado_en',
		'modificado_en',
		'activo'
	];

	public function usuario_almacen()
	{
		return $this->belongsTo(UsuarioAlmacen::class, 'dar_stock');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}
}
