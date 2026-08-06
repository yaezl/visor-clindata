<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipodiagnostico
 * 
 * @property int $id
 * @property string $nombre
 * 
 * @property Collection|Clasediagnostico[] $clasediagnosticos
 * @property Collection|Diagnostico[] $diagnosticos
 * @property Collection|Subtipodiagnostico[] $subtipodiagnosticos
 *
 * @package App\Models
 */
class Tipodiagnostico extends Model
{
	protected $table = 'tipodiagnostico';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];

	public function clasediagnosticos()
	{
		return $this->hasMany(Clasediagnostico::class, 'tipo_id');
	}

	public function diagnosticos()
	{
		return $this->hasMany(Diagnostico::class, 'tipo_id');
	}

	public function subtipodiagnosticos()
	{
		return $this->hasMany(Subtipodiagnostico::class);
	}
}
