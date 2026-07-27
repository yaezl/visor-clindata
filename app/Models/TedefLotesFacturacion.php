<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TedefLotesFacturacion
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $institucion_id
 * @property int $plan_id
 * @property int|null $numero
 * @property string $tipo_lote
 * @property string $observacion
 * @property bool $trama_generada
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property Carbon|null $fecha_envio
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Institucion $institucion
 * @property Plan $plan
 * @property Collection|TedefItemFacturacion[] $tedef_item_facturacions
 *
 * @package App\Models
 */
class TedefLotesFacturacion extends Model
{
	protected $table = 'tedef_lotes_facturacion';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'institucion_id' => 'int',
		'plan_id' => 'int',
		'numero' => 'int',
		'trama_generada' => 'bool',
		'modified_at' => 'datetime',
		'fecha_envio' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'institucion_id',
		'plan_id',
		'numero',
		'tipo_lote',
		'observacion',
		'trama_generada',
		'modified_at',
		'fecha_envio',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function tedef_item_facturacions()
	{
		return $this->hasMany(TedefItemFacturacion::class, 'lote_id');
	}
}
