<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnidadNegocio
 * 
 * @property int $id
 * @property int $creadopor_id
 * @property int $modificadopor_id
 * @property string $nombre
 * @property string $codigo
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario $usuario
 * @property Collection|Bonocriterio[] $bonocriterios
 * @property Collection|Bonoitem[] $bonoitems
 * @property Collection|Prestacion[] $prestacions
 *
 * @package App\Models
 */
class UnidadNegocio extends Model
{
	protected $table = 'unidadNegocio';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'nombre',
		'codigo',
		'creado_en',
		'modificado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creadopor_id');
	}

	public function bonocriterios()
	{
		return $this->hasMany(Bonocriterio::class);
	}

	public function bonoitems()
	{
		return $this->hasMany(Bonoitem::class);
	}

	public function prestacions()
	{
		return $this->hasMany(Prestacion::class);
	}
}
