<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RelacionArticulotpPrestacion
 * 
 * @property int $id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $articulotipopresentacion_id
 * @property int|null $laboratorio_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property ArticuloTipopresentacion|null $articulo_tipopresentacion
 * @property Collection|ArticulotpPrestacion[] $articulotp_prestacions
 *
 * @package App\Models
 */
class RelacionArticulotpPrestacion extends Model
{
	protected $table = 'relacion_articulotp_prestacion';

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'articulotipopresentacion_id' => 'int',
		'laboratorio_id' => 'int',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'articulotipopresentacion_id',
		'laboratorio_id',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function articulo_tipopresentacion()
	{
		return $this->belongsTo(ArticuloTipopresentacion::class, 'articulotipopresentacion_id');
	}

	public function articulotp_prestacions()
	{
		return $this->hasMany(ArticulotpPrestacion::class, 'relacion_atp_prestacion_id');
	}
}
