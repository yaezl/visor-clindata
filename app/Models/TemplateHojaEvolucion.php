<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemplateHojaEvolucion
 * 
 * @property int $id
 * @property bool $borradoLogico
 * @property Carbon|null $modifiedAt
 * @property string $template
 * @property string $codigo
 * @property Carbon $createdAt
 * @property int|null $modifiedBy
 * @property int $createdBy
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class TemplateHojaEvolucion extends Model
{
	protected $table = 'template_hoja_evolucion';
	public $timestamps = false;

	protected $casts = [
		'borradoLogico' => 'bool',
		'modifiedAt' => 'datetime',
		'createdAt' => 'datetime',
		'modifiedBy' => 'int',
		'createdBy' => 'int'
	];

	protected $fillable = [
		'borradoLogico',
		'modifiedAt',
		'template',
		'codigo',
		'createdAt',
		'modifiedBy',
		'createdBy'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'modifiedBy');
	}
}
