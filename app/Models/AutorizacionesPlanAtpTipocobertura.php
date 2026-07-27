<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AutorizacionesPlanAtpTipocobertura
 * 
 * @property int $id
 * @property int $modified_by
 * @property int $created_by
 * @property int $atp_id
 * @property int $plan_id
 * @property int|null $tipocobertura_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Usuario $usuario
 * @property AutorizacionesTipoCobertura|null $autorizaciones_tipo_cobertura
 * @property ArticuloTipopresentacion $articulo_tipopresentacion
 * @property Plan $plan
 *
 * @package App\Models
 */
class AutorizacionesPlanAtpTipocobertura extends Model
{
	protected $table = 'autorizaciones_plan_atp_tipocobertura';

	protected $casts = [
		'modified_by' => 'int',
		'created_by' => 'int',
		'atp_id' => 'int',
		'plan_id' => 'int',
		'tipocobertura_id' => 'int'
	];

	protected $fillable = [
		'modified_by',
		'created_by',
		'atp_id',
		'plan_id',
		'tipocobertura_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function autorizaciones_tipo_cobertura()
	{
		return $this->belongsTo(AutorizacionesTipoCobertura::class, 'tipocobertura_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'atp_id');
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}
}
