<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Plansocial
 * 
 * @property int $id
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $eliminado_por_id
 * @property string $nombre
 * @property Carbon $creado_en
 * @property Carbon|null $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 * @property Collection|Persona[] $personas
 *
 * @package App\Models
 */
class Plansocial extends Model
{
	protected $table = 'plansocial';
	public $timestamps = false;

	protected $casts = [
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'eliminado_por_id' => 'int',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'creado_por_id',
		'modificado_por_id',
		'eliminado_por_id',
		'nombre',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminado_por_id');
	}

	public function personas()
	{
		return $this->belongsToMany(Persona::class)
					->withPivot('id', 'origenplansocial_id', 'tipo_beneficiario_id', 'tipo_parentesco_id', 'creado_por_id', 'modificado_por_id', 'eliminado_por_id', 'observacion', 'creado_en', 'modificado_en', 'borrado_en', 'fecha_caducidad', 'pension', 'certificado');
	}
}
