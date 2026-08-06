<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HcHerramienta
 * 
 * @property int $id
 * @property int|null $permiso_boton
 * @property string|null $url
 * @property string $icono
 * @property string|null $dato
 * @property string|null $dato_a_reemplazar
 * @property string $nombre_boton
 * 
 * @property Permiso|null $permiso
 *
 * @package App\Models
 */
class HcHerramienta extends Model
{
	protected $table = 'hc_herramientas';
	public $timestamps = false;

	protected $casts = [
		'permiso_boton' => 'int'
	];

	protected $fillable = [
		'permiso_boton',
		'url',
		'icono',
		'dato',
		'dato_a_reemplazar',
		'nombre_boton'
	];

	public function permiso()
	{
		return $this->belongsTo(Permiso::class, 'permiso_boton');
	}
}
