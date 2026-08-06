<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SuministrosCuentum
 * 
 * @property int $id
 * @property int|null $creadopor_id
 * @property int|null $modificadopor_id
 * @property int|null $borradopor_id
 * @property string $nombre
 * @property string $numero
 * @property string $cbu
 * @property string|null $descripcion
 * @property int $contable
 * @property bool $activa
 * @property bool $efectivo
 * @property bool $cheque
 * @property bool $transferencia
 * @property bool $tarjeta
 * @property bool $pagare
 * @property Carbon $creado_en
 * @property Carbon $modificado_en
 * @property Carbon|null $borrado_en
 * @property bool $borrado_logico
 * 
 * @property Usuario|null $usuario
 *
 * @package App\Models
 */
class SuministrosCuentum extends Model
{
	protected $table = 'suministros_cuenta';
	public $timestamps = false;

	protected $casts = [
		'creadopor_id' => 'int',
		'modificadopor_id' => 'int',
		'borradopor_id' => 'int',
		'contable' => 'int',
		'activa' => 'bool',
		'efectivo' => 'bool',
		'cheque' => 'bool',
		'transferencia' => 'bool',
		'tarjeta' => 'bool',
		'pagare' => 'bool',
		'creado_en' => 'datetime',
		'modificado_en' => 'datetime',
		'borrado_en' => 'datetime',
		'borrado_logico' => 'bool'
	];

	protected $fillable = [
		'creadopor_id',
		'modificadopor_id',
		'borradopor_id',
		'nombre',
		'numero',
		'cbu',
		'descripcion',
		'contable',
		'activa',
		'efectivo',
		'cheque',
		'transferencia',
		'tarjeta',
		'pagare',
		'creado_en',
		'modificado_en',
		'borrado_en',
		'borrado_logico'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'borradopor_id');
	}
}
