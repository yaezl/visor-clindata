<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BrokerConfig
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property int $institucion_id
 * @property int $obra_social_id
 * @property int|null $broker_id
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property string $prestador_id
 * @property string $tipo_prestador
 * @property string|null $tipoPrestacion
 * 
 * @property Usuario $usuario
 * @property Broker|null $broker
 * @property ObraSocial $obra_social
 * @property Institucion $institucion
 *
 * @package App\Models
 */
class BrokerConfig extends Model
{
	protected $table = 'broker_config';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'institucion_id' => 'int',
		'obra_social_id' => 'int',
		'broker_id' => 'int',
		'modified_at' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'institucion_id',
		'obra_social_id',
		'broker_id',
		'modified_at',
		'prestador_id',
		'tipo_prestador',
		'tipoPrestacion'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function broker()
	{
		return $this->belongsTo(Broker::class);
	}

	public function obra_social()
	{
		return $this->belongsTo(ObraSocial::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
