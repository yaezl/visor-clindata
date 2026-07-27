<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosCitum
 * 
 * @property int $id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property Carbon|null $fecha
 * @property string|null $notas
 * @property string $estado
 * @property string|null $deposito
 * @property string|null $numero_acta
 * @property string|null $tipo_acta
 * @property string|null $notas_acta
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosCitum extends Model
{
	protected $table = 'suministros_cita';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'fecha' => 'datetime',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'fecha',
		'notas',
		'estado',
		'deposito',
		'numero_acta',
		'tipo_acta',
		'notas_acta',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
