<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosCentroDeCosto
 * 
 * @property int $id
 * @property int|null $institucion_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $codigo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosCentroDeCosto extends Model
{
	protected $table = 'suministros_centro_de_costo';
	public $timestamps = false;

	protected $casts = [
		'institucion_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'institucion_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'nombre',
		'descripcion',
		'codigo',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
