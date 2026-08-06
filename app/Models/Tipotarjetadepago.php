<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipotarjetadepago
 * 
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon|null $modificado_en
 * @property bool $borrado_logico
 * @property Carbon $creado_en
 * 
 * @property Usuario|null $usuario
 * @property Collection|Tarjetadepago[] $tarjetadepagos
 *
 * @package App\Models
 */
class Tipotarjetadepago extends Model
{
	protected $table = 'tipotarjetadepago';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool',
		'creado_en' => 'datetime'
	];

	protected $fillable = [
		'nombre',
		'codigo',
		'creado_por_id',
		'modificado_por_id',
		'modificado_en',
		'borrado_logico',
		'creado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function tarjetadepagos()
	{
		return $this->hasMany(Tarjetadepago::class);
	}
}
