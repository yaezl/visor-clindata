<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosRenglonVale
 * 
 * @property int $id
 * @property int|null $vale_id
 * @property int|null $suministro_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property int|null $entregadopor_id
 * @property int|null $retiradopor_id
 * @property int|null $anuladopor_id
 * @property float $cantidad
 * @property float|null $cantidadRecibida
 * @property string|null $comentarios
 * @property bool|null $entregado
 * @property bool|null $anulado
 * @property string|null $motivo_anulacion
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property Carbon|null $entregado_en
 * @property Carbon|null $anulado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosRenglonVale extends Model
{
	protected $table = 'suministros_renglon_vale';
	public $timestamps = false;

	protected $casts = [
		'vale_id' => 'int',
		'suministro_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'entregadopor_id' => 'int',
		'retiradopor_id' => 'int',
		'anuladopor_id' => 'int',
		'cantidad' => 'float',
		'cantidadRecibida' => 'float',
		'entregado' => 'bool',
		'anulado' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'entregado_en' => 'datetime',
		'anulado_en' => 'datetime'
	];

	protected $fillable = [
		'vale_id',
		'suministro_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'entregadopor_id',
		'retiradopor_id',
		'anuladopor_id',
		'cantidad',
		'cantidadRecibida',
		'comentarios',
		'entregado',
		'anulado',
		'motivo_anulacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'entregado_en',
		'anulado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'anuladopor_id');
	}
}
