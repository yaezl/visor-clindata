<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TokenSiat
 * 
 * @property int $id
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $centro_de_costo_id
 * @property int $numero_tramite
 * @property int $numero_autorizacion
 * @property int $numero_factura
 * @property string|null $leyenda_actividad_economica
 * @property string|null $leyenda_ley
 * @property Carbon $fecha_limite_de_emision
 * @property string $llave_dosificacion
 * @property Carbon $created_at
 * @property Carbon|null $modified_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Centrodecosto|null $centrodecosto
 *
 * @package App\Models
 */
class TokenSiat extends Model
{
	protected $table = 'token_siat';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'centro_de_costo_id' => 'int',
		'numero_tramite' => 'int',
		'numero_autorizacion' => 'int',
		'numero_factura' => 'int',
		'fecha_limite_de_emision' => 'datetime',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'centro_de_costo_id',
		'numero_tramite',
		'numero_autorizacion',
		'numero_factura',
		'leyenda_actividad_economica',
		'leyenda_ley',
		'fecha_limite_de_emision',
		'llave_dosificacion',
		'modified_at',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function centrodecosto()
	{
		return $this->belongsTo(Centrodecosto::class, 'centro_de_costo_id');
	}
}
