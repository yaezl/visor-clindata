<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkCierreInventario
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $finalizado
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class StkCierreInventario extends Model
{
	protected $table = 'stk_cierre_inventario';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'finalizado' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'finalizado'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}
}
