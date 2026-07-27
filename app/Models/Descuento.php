<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Descuento
 * 
 * @property int $id
 * @property int $creadopor_id
 * @property int $modificadopor_id
 * @property string $nombre
 * @property string|null $codigo
 * @property float $porcentajeDescuento
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Collection|RequiereDescuento[] $requiere_descuentos
 *
 * @package App\Models
 */
class Descuento extends Model
{
	protected $table = 'descuento';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'porcentajeDescuento' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'nombre',
		'codigo',
		'porcentajeDescuento',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function requiere_descuentos()
	{
		return $this->hasMany(RequiereDescuento::class);
	}
}
