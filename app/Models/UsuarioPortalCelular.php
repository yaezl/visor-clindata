<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPortalCelular
 * 
 * @property int $id
 * @property int $pais_id
 * @property string $celular_codigo
 * @property string $celular_numero
 * @property string $codigo_internacional
 * @property string $celular
 * @property string|null $carrier
 * @property bool $validado
 * 
 * @property UsuarioPortal $usuario_portal
 * @property Pai $pai
 *
 * @package App\Models
 */
class UsuarioPortalCelular extends Model
{
	protected $table = 'usuario_portal_celular';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'pais_id' => 'int',
		'validado' => 'bool'
	];

	protected $fillable = [
		'pais_id',
		'celular_codigo',
		'celular_numero',
		'codigo_internacional',
		'celular',
		'carrier',
		'validado'
	];

	public function usuario_portal()
	{
		return $this->belongsTo(UsuarioPortal::class, 'id');
	}

	public function pai()
	{
		return $this->belongsTo(Pai::class, 'pais_id');
	}
}
