<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosSuministro
 * 
 * @property int $id
 * @property int|null $categoria_id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $eliminadopor_id
 * @property string $nombre
 * @property float|null $ultimo_precio
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosSuministro extends Model
{
	protected $table = 'suministros_suministro';
	public $timestamps = false;

	protected $casts = [
		'categoria_id' => 'int',
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'eliminadopor_id' => 'int',
		'ultimo_precio' => 'float',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime'
	];

	protected $fillable = [
		'categoria_id',
		'creadopor_id',
		'modificadopor_id',
		'eliminadopor_id',
		'nombre',
		'ultimo_precio',
		'creado_en',
		'modificado_en',
		'borrado_en'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'eliminadopor_id');
	}
}
