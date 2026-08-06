<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AdminConfiguracionTemporal
 * 
 * @property int $id
 * @property int|null $criterio_comparacion_id
 * @property int|null $tipo_periodo_id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int $cantidad
 * @property string $descripcion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * @property int $orden
 * @property string $descripcion_amplia
 * 
 * @property AdminCriterioComparacion|null $admin_criterio_comparacion
 * @property AdminTipoPeriodo|null $admin_tipo_periodo
 * @property Usuario|null $usuario
 * @property Collection|HcAplicacionVacuna[] $hc_aplicacion_vacunas
 *
 * @package App\Models
 */
class AdminConfiguracionTemporal extends Model
{
	protected $table = 'admin_configuracion_temporal';
	public $timestamps = false;

	protected $casts = [
		'criterio_comparacion_id' => 'int',
		'tipo_periodo_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'cantidad' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'orden' => 'int'
	];

	protected $fillable = [
		'criterio_comparacion_id',
		'tipo_periodo_id',
		'creado_por_id',
		'modificado_por_id',
		'cantidad',
		'descripcion',
		'creado_en',
		'modificado_en',
		'borrado_logico',
		'orden',
		'descripcion_amplia'
	];

	public function admin_criterio_comparacion()
	{
		return $this->belongsTo(AdminCriterioComparacion::class, 'criterio_comparacion_id');
	}

	public function admin_tipo_periodo()
	{
		return $this->belongsTo(AdminTipoPeriodo::class, 'tipo_periodo_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function hc_aplicacion_vacunas()
	{
		return $this->hasMany(HcAplicacionVacuna::class, 'configuracion_temporal_id');
	}
}
