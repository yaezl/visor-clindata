<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UbicacionAlmacen
 * 
 * @property int $id
 * @property string $nombre
 * @property bool $borradoLogico
 * @property Carbon $creadoEn
 * @property Carbon|null $modificadoEn
 * @property int $creadoPor
 * @property int|null $modificadoPor
 * 
 * @property Usuario|null $usuario
 * @property Collection|ArticuloTipopresentacion[] $articulo_tipopresentacions
 *
 * @package App\Models
 */
class UbicacionAlmacen extends Model
{
	protected $table = 'ubicacionAlmacen';
	public $timestamps = false;

	protected $casts = [
		'borradoLogico' => 'bool',
		'creadoEn' => 'datetime',
		'modificadoEn' => 'datetime',
		'creadoPor' => 'int',
		'modificadoPor' => 'int'
	];

	protected $fillable = [
		'nombre',
		'borradoLogico',
		'creadoEn',
		'modificadoEn',
		'creadoPor',
		'modificadoPor'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificadoPor');
	}

	public function articulo_tipopresentacions()
	{
		return $this->hasMany(ArticuloTipopresentacion::class, 'idUbicacionAlmacen');
	}
}
