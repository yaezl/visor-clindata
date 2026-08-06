<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosDescarga
 * 
 * @property int $id
 * @property int|null $cronograma_de_entrega_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property Carbon|null $fecha
 * @property float $cantidad
 * @property string|null $tipo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosDescarga extends Model
{
	protected $table = 'suministros_descarga';
	public $timestamps = false;

	protected $casts = [
		'cronograma_de_entrega_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'fecha' => 'datetime',
		'cantidad' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'cronograma_de_entrega_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'fecha',
		'cantidad',
		'tipo',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
