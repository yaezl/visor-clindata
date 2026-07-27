<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Config
 * 
 * @property int $id
 * @property int|null $modulo_id
 * @property int|null $institucion_id
 * @property int $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string $nombre
 * @property string $valor
 * @property string|null $codigo
 * @property string|null $observacion
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Modulo|null $modulo
 * @property Institucion|null $institucion
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class Config extends Model
{
	protected $table = 'config';
	public $timestamps = false;

	protected $casts = [
		'modulo_id' => 'int',
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
		'modulo_id',
		'institucion_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'nombre',
		'valor',
		'codigo',
		'observacion',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function modulo()
	{
		return $this->belongsTo(Modulo::class);
	}

	public function institucion()
	{
		return $this->belongsTo(Institucion::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
