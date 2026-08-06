<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosVale
 * 
 * @property int $id
 * @property int|null $estado_id
 * @property int|null $institucion_id
 * @property int|null $responsable_id
 * @property int|null $dependencia_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property int|null $activadopor_id
 * @property int|null $autorizadopor_id
 * @property Carbon $fecha_de_vale
 * @property string|null $comentarios
 * @property bool|null $autorizado
 * @property bool|null $entregado
 * @property string|null $motivo_rechazo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property Carbon|null $activado_en
 * @property Carbon|null $autorizado_en
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosVale extends Model
{
	protected $table = 'suministros_vales';
	public $timestamps = false;

	protected $casts = [
		'estado_id' => 'int',
		'institucion_id' => 'int',
		'responsable_id' => 'int',
		'dependencia_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'activadopor_id' => 'int',
		'autorizadopor_id' => 'int',
		'fecha_de_vale' => 'datetime',
		'autorizado' => 'bool',
		'entregado' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'activado_en' => 'datetime',
		'autorizado_en' => 'datetime'
	];

	protected $fillable = [
		'estado_id',
		'institucion_id',
		'responsable_id',
		'dependencia_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'activadopor_id',
		'autorizadopor_id',
		'fecha_de_vale',
		'comentarios',
		'autorizado',
		'entregado',
		'motivo_rechazo',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'activado_en',
		'autorizado_en'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class, 'dependencia_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'autorizadopor_id');
	}
}
