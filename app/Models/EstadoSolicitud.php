<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstadoSolicitud
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $codigo
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon $eliminado_en
 * @property bool $borrado_logico
 * @property bool $estado_sol
 * @property bool $estado_vale
 * @property bool $estado_viatico
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class EstadoSolicitud extends Model
{
	protected $table = 'estado_solicitud';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'eliminado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'estado_sol' => 'bool',
		'estado_vale' => 'bool',
		'estado_viatico' => 'bool'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'codigo',
		'descripcion',
		'creado_en',
		'modificado_en',
		'eliminado_en',
		'borrado_logico',
		'estado_sol',
		'estado_vale',
		'estado_viatico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
