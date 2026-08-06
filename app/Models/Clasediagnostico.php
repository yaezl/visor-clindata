<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Clasediagnostico
 * 
 * @property int $id
 * @property int|null $tipo_id
 * @property int|null $subtipo_id
 * @property string $nombre
 * 
 * @property Tipodiagnostico|null $tipodiagnostico
 * @property Subtipodiagnostico|null $subtipodiagnostico
 * @property Collection|Diagnostico[] $diagnosticos
 *
 * @package App\Models
 */
class Clasediagnostico extends Model
{
	protected $table = 'clasediagnostico';
	public $timestamps = false;

	protected $casts = [
		'tipo_id' => 'int',
		'subtipo_id' => 'int'
	];

	protected $fillable = [
		'tipo_id',
		'subtipo_id',
		'nombre'
	];

	public function tipodiagnostico()
	{
		return $this->belongsTo(Tipodiagnostico::class, 'tipo_id');
	}

	public function subtipodiagnostico()
	{
		return $this->belongsTo(Subtipodiagnostico::class, 'subtipo_id');
	}

	public function diagnosticos()
	{
		return $this->hasMany(Diagnostico::class, 'clase_id');
	}
}
