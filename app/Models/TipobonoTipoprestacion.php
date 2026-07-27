<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipobonoTipoprestacion
 * 
 * @property int $id
 * @property int|null $tipobono_id
 * @property int|null $tipoprestacion_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Tipobono|null $tipobono
 * @property Tipoprestacion|null $tipoprestacion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class TipobonoTipoprestacion extends Model
{
	protected $table = 'tipobono_tipoprestacion';
	public $timestamps = false;

	protected $casts = [
		'tipobono_id' => 'int',
		'tipoprestacion_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'tipobono_id',
		'tipoprestacion_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function tipobono()
	{
		return $this->belongsTo(Tipobono::class);
	}

	public function tipoprestacion()
	{
		return $this->belongsTo(Tipoprestacion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
