<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FarBloqueoAlmacen
 * 
 * @property int $id
 * @property int $created_by
 * @property int $updated_by
 * @property int $almacen_id
 * @property bool $bloqueado
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Almacen $almacen
 *
 * @package App\Models
 */
class FarBloqueoAlmacen extends Model
{
	protected $table = 'far_bloqueo_almacen';

	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int',
		'almacen_id' => 'int',
		'bloqueado' => 'bool',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'updated_by',
		'almacen_id',
		'bloqueado',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}
}
