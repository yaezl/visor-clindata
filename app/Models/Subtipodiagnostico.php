<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subtipodiagnostico
 * 
 * @property int $id
 * @property int|null $tipodiagnostico_id
 * @property string $nombre
 * 
 * @property Tipodiagnostico|null $tipodiagnostico
 * @property Collection|Clasediagnostico[] $clasediagnosticos
 * @property Collection|Diagnostico[] $diagnosticos
 *
 * @package App\Models
 */
class Subtipodiagnostico extends Model
{
	protected $table = 'subtipodiagnostico';
	public $timestamps = false;

	protected $casts = [
		'tipodiagnostico_id' => 'int'
	];

	protected $fillable = [
		'tipodiagnostico_id',
		'nombre'
	];

	public function tipodiagnostico()
	{
		return $this->belongsTo(Tipodiagnostico::class);
	}

	public function clasediagnosticos()
	{
		return $this->hasMany(Clasediagnostico::class, 'subtipo_id');
	}

	public function diagnosticos()
	{
		return $this->hasMany(Diagnostico::class, 'subtipo_id');
	}
}
