<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EstudioPrestacion
 * 
 * @property int|null $estudio_id
 * @property int|null $prestacion_id
 * @property int $cantidad
 * @property int $id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property int|null $institucion_id
 * 
 * @property Estudio|null $estudio
 * @property Prestacion|null $prestacion
 * @property Usuario|null $usuario
 * @property Institucion|null $institucion
 *
 * @package App\Models
 */
class EstudioPrestacion extends Model
{
	protected $table = 'estudio_prestacion';
	public $timestamps = false;

	protected $casts = [
		'estudio_id' => 'int',
		'prestacion_id' => 'int',
		'cantidad' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'institucion_id' => 'int'
	];

	protected $fillable = [
		'estudio_id',
		'prestacion_id',
		'cantidad',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'institucion_id'
	];

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
