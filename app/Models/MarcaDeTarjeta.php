<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MarcaDeTarjeta
 * 
 * @property int $id
 * @property int $created_by
 * @property int $modified_by
 * @property string $nombre_marca
 * @property bool $borrado_logico
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * 
 * @property Usuario $usuario
 * @property Collection|Tarjetadepago[] $tarjetadepagos
 *
 * @package App\Models
 */
class MarcaDeTarjeta extends Model
{
	protected $table = 'marca_de_tarjetas';
	public $timestamps = false;

	protected $casts = [
		'created_by' => 'int',
		'modified_by' => 'int',
		'borrado_logico' => 'bool',
		'modified_at' => 'datetime'
	];

	protected $fillable = [
		'created_by',
		'modified_by',
		'nombre_marca',
		'borrado_logico',
		'modified_at'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'created_by');
	}

	public function tarjetadepagos()
	{
		return $this->hasMany(Tarjetadepago::class, 'marca_de_tarjetas_id');
	}
}
