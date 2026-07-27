<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Banco
 * 
 * @property int $id
 * @property string $nombre
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 * @property Collection|Cheque[] $cheques
 * @property Collection|SuministrosPagosDetalle[] $suministros_pagos_detalles
 * @property Collection|Tarjetadepago[] $tarjetadepagos
 *
 * @package App\Models
 */
class Banco extends Model
{
	protected $table = 'banco';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'nombre',
		'creado_por_id',
		'modificado_por_id',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modificado_por_id');
	}

	public function cheques()
	{
		return $this->hasMany(Cheque::class);
	}

	public function suministros_pagos_detalles()
	{
		return $this->hasMany(SuministrosPagosDetalle::class);
	}

	public function tarjetadepagos()
	{
		return $this->hasMany(Tarjetadepago::class);
	}
}
