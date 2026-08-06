<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Articuloalmacenminmax
 * 
 * @property int $id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $almacen_id
 * @property float $minimo
 * @property float $maximo
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property float $actual
 * @property float $critico
 * 
 * @property Almacen|null $almacen
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Articuloalmacenminmax extends Model
{
	protected $table = 'articuloalmacenminmax';
	public $timestamps = false;

	protected $casts = [
		'articulotipopresentacion_id' => 'int',
		'almacen_id' => 'int',
		'minimo' => 'float',
		'maximo' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'actual' => 'float',
		'critico' => 'float'
	];

	protected $fillable = [
		'articulotipopresentacion_id',
		'almacen_id',
		'minimo',
		'maximo',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'actual',
		'critico'
	];

	public function almacen()
	{
		return $this->belongsTo(Almacen::class);
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}
}
