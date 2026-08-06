<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosCronogramaDeEntrega
 * 
 * @property int $id
 * @property int|null $cita_id
 * @property int|null $renglon_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property Carbon|null $fecha
 * @property int $plazo
 * @property float $cantidad
 * @property string|null $estado
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosCronogramaDeEntrega extends Model
{
	protected $table = 'suministros_cronograma_de_entrega';
	public $timestamps = false;

	protected $casts = [
		'cita_id' => 'int',
		'renglon_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'fecha' => 'datetime',
		'plazo' => 'int',
		'cantidad' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'cita_id',
		'renglon_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'fecha',
		'plazo',
		'cantidad',
		'estado',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
