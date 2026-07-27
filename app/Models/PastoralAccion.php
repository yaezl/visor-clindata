<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PastoralAccion
 * 
 * @property int $id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * 
 * @property Usuario|null $usuario
 * @property Collection|PastoralEventoAccion[] $pastoral_evento_accions
 *
 * @package App\Models
 */
class PastoralAccion extends Model
{
	protected $table = 'pastoral_accion';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'nombre',
		'creado_en',
		'modificado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function pastoral_evento_accions()
	{
		return $this->hasMany(PastoralEventoAccion::class, 'accion_id');
	}
}
