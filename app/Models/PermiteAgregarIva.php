<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermiteAgregarIva
 * 
 * @property int $id
 * @property bool $permite_agregar_iva
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class PermiteAgregarIva extends Model
{
	protected $table = 'permite_agregar_iva';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'permite_agregar_iva' => 'bool'
	];

	protected $fillable = [
		'permite_agregar_iva'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
