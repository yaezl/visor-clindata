<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CapituloodontologiaEstudio
 * 
 * @property int $id
 * @property int|null $capituloodontologia_id
 * @property int|null $estudio_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property bool $a_caras
 * @property bool $a_solo_una_pieza
 * @property bool $a_varias_piezas
 * @property bool $a_boca
 * @property bool $a_arcada
 * @property bool $bloqueante
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * @property bool $palatina
 * @property bool $cervical
 * @property bool $incisal
 * 
 * @property Capituloodontologium|null $capituloodontologium
 * @property Estudio|null $estudio
 * @property Usuario|null $usuario
 * @property Collection|Capituloodontoestudiodibujo[] $capituloodontoestudiodibujos
 * @property Collection|Odontoaplicacion[] $odontoaplicacions
 *
 * @package App\Models
 */
class CapituloodontologiaEstudio extends Model
{
	protected $table = 'capituloodontologia_estudio';
	public $timestamps = false;

	protected $casts = [
		'capituloodontologia_id' => 'int',
		'estudio_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'a_caras' => 'bool',
		'a_solo_una_pieza' => 'bool',
		'a_varias_piezas' => 'bool',
		'a_boca' => 'bool',
		'a_arcada' => 'bool',
		'bloqueante' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'palatina' => 'bool',
		'cervical' => 'bool',
		'incisal' => 'bool'
	];

	protected $fillable = [
		'capituloodontologia_id',
		'estudio_id',
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'a_caras',
		'a_solo_una_pieza',
		'a_varias_piezas',
		'a_boca',
		'a_arcada',
		'bloqueante',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico',
		'palatina',
		'cervical',
		'incisal'
	];

	public function capituloodontologium()
	{
		return $this->belongsTo(Capituloodontologium::class, 'capituloodontologia_id');
	}

	public function estudio()
	{
		return $this->belongsTo(Estudio::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}

	public function capituloodontoestudiodibujos()
	{
		return $this->hasMany(Capituloodontoestudiodibujo::class, 'capituloestudio_id');
	}

	public function odontoaplicacions()
	{
		return $this->hasMany(Odontoaplicacion::class, 'capituloestudio_id');
	}
}
