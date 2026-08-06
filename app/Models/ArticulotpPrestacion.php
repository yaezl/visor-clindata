<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ArticulotpPrestacion
 * 
 * @property int $id
 * @property int|null $relacion_atp_prestacion_id
 * @property int|null $prestacion_id
 * @property int|null $institucion_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int $cantidad
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * 
 * @property RelacionArticulotpPrestacion|null $relacion_articulotp_prestacion
 * @property Usuario|null $usuario
 * @property Prestacion|null $prestacion
 * @property Institucion|null $institucion
 *
 * @package App\Models
 */
class ArticulotpPrestacion extends Model
{
	protected $table = 'articulotp_prestacion';
	public $timestamps = false;

	protected $casts = [
		'relacion_atp_prestacion_id' => 'int',
		'prestacion_id' => 'int',
		'institucion_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'cantidad' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'relacion_atp_prestacion_id',
		'prestacion_id',
		'institucion_id',
		'creadopor_id',
		'modificadopor_id',
		'cantidad',
		'creado_en',
		'modificado_en'
	];

	public function relacion_articulotp_prestacion()
	{
		return $this->belongsTo(RelacionArticulotpPrestacion::class, 'relacion_atp_prestacion_id');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function prestacion()
	{
		return $this->belongsTo(Prestacion::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}
}
