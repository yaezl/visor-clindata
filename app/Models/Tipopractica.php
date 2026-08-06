<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tipopractica
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * 
 * @property Collection|DebitosYCredito[] $debitos_y_creditos
 * @property Collection|Estudio[] $estudios
 * @property Collection|PrestacionEnfermerium[] $prestacion_enfermeria
 *
 * @package App\Models
 */
class Tipopractica extends Model
{
	protected $table = 'tipopractica';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'codigo'
	];

	public function debitos_y_creditos()
	{
		return $this->hasMany(DebitosYCredito::class, 'tipo_practica_id');
	}

	public function estudios()
	{
		return $this->hasMany(Estudio::class);
	}

	public function prestacion_enfermeria()
	{
		return $this->hasMany(PrestacionEnfermerium::class);
	}
}
