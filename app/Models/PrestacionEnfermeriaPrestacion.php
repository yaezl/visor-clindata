<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PrestacionEnfermeriaPrestacion
 * 
 * @property int $id
 * @property int|null $prestacion_enfermeria_id
 * @property int|null $prestacion_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property int $cantidad
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property PrestacionEnfermerium|null $prestacion_enfermerium
 * @property Prestacion|null $prestacion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class PrestacionEnfermeriaPrestacion extends Model
{
	protected $table = 'prestacion_enfermeria_prestacion';
	public $timestamps = false;

	protected $casts = [
		'prestacion_enfermeria_id' => 'int',
		'prestacion_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'cantidad' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'prestacion_enfermeria_id',
		'prestacion_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'cantidad',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function prestacion_enfermerium()
	{
		return $this->belongsTo(PrestacionEnfermerium::class, 'prestacion_enfermeria_id');
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
