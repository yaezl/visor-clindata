<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Capituloodontologium
 * 
 * @property int $id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string $nombre
 * @property string|null $codigo
 * @property bool $bloqueante
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|Capituloodontodibujo[] $capituloodontodibujos
 * @property Collection|CapituloodontologiaEstudio[] $capituloodontologia_estudios
 * @property Collection|Odontoaplicacion[] $odontoaplicacions
 *
 * @package App\Models
 */
class Capituloodontologium extends Model
{
	protected $table = 'capituloodontologia';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'bloqueante' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'nombre',
		'codigo',
		'bloqueante',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}

	public function capituloodontodibujos()
	{
		return $this->hasMany(Capituloodontodibujo::class, 'capitulo_id');
	}

	public function capituloodontologia_estudios()
	{
		return $this->hasMany(CapituloodontologiaEstudio::class, 'capituloodontologia_id');
	}

	public function odontoaplicacions()
	{
		return $this->hasMany(Odontoaplicacion::class, 'capituloodontologia_id');
	}
}
