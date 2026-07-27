<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StkArticuloalmacenminmax
 * 
 * @property int $id
 * @property int|null $almacen_id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property float $minimo
 * @property float $maximo
 * @property float $actual
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class StkArticuloalmacenminmax extends Model
{
	protected $table = 'stk_articuloalmacenminmax';
	public $timestamps = false;

	protected $casts = [
		'almacen_id' => 'int',
		'articulotipopresentacion_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'minimo' => 'float',
		'maximo' => 'float',
		'actual' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'almacen_id',
		'articulotipopresentacion_id',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'minimo',
		'maximo',
		'actual',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
