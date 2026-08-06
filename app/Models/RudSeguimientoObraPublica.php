<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RudSeguimientoObraPublica
 * 
 * @property int $id
 * @property int|null $archivo_id
 * @property int|null $empresa_id
 * @property int|null $agenciafinancia_id
 * @property int|null $categoriaobra_id
 * @property int|null $subcategoriaobra_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $borrado_por_id
 * @property string $licitacion
 * @property string $nombre
 * @property string|null $detalle
 * @property float $monto
 * @property string $estado
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Archivo|null $archivo
 * @property Empleador|null $empleador
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class RudSeguimientoObraPublica extends Model
{
	protected $table = 'rud_seguimiento_obra_publica';
	public $timestamps = false;

	protected $casts = [
		'archivo_id' => 'int',
		'empresa_id' => 'int',
		'agenciafinancia_id' => 'int',
		'categoriaobra_id' => 'int',
		'subcategoriaobra_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'borrado_por_id' => 'int',
		'monto' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'archivo_id',
		'empresa_id',
		'agenciafinancia_id',
		'categoriaobra_id',
		'subcategoriaobra_id',
		'creado_por_id',
		'modificado_por_id',
		'borrado_por_id',
		'licitacion',
		'nombre',
		'detalle',
		'monto',
		'estado',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function archivo()
	{
		return $this->belongsTo(Archivo::class);
	}

	public function empleador()
	{
		return $this->belongsTo(Empleador::class, 'empresa_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borrado_por_id');
	}
}
