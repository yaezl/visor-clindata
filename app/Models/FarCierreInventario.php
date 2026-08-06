<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarCierreInventario
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $finalizado
 * @property int|null $institucion_id
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 * @property Collection|Almacen[] $almacens
 *
 * @package App\Models
 */
class FarCierreInventario extends Model
{
	protected $table = 'far_cierre_inventario';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'finalizado' => 'bool',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'finalizado',
		'institucion_id'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function almacens()
	{
		return $this->belongsToMany(Almacen::class, 'far_cierre_inventario_almacen', 'cierre_inventario_id')
					->withPivot('id', 'creado_por_id', 'modificado_por_id', 'creado_en', 'modificado_en', 'finalizado');
	}
}
