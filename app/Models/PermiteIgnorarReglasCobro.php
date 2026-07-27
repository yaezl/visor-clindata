<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermiteIgnorarReglasCobro
 * 
 * @property int $id
 * @property bool $permite_ignorar_reglas_cobro
 * 
 * @property Atributo $atributo
 *
 * @package App\Models
 */
class PermiteIgnorarReglasCobro extends Model
{
	protected $table = 'permite_ignorar_reglas_cobro';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'permite_ignorar_reglas_cobro' => 'bool'
	];

	protected $fillable = [
		'permite_ignorar_reglas_cobro'
	];

	public function atributo()
	{
		return $this->belongsTo(Atributo::class, 'id');
	}
}
