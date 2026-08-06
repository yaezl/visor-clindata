<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TedefOdontoBonoitem
 * 
 * @property int $id
 * @property int|null $bonoitem_id
 * @property int $creado_por_id
 * @property int|null $modificado_por_id
 * @property int|null $pieza_dentaria
 * @property string|null $superficie
 * @property Carbon $created_at
 * @property Carbon $modified_at
 * @property bool $borrado_logico
 * @property int|null $itembono_id
 * 
 * @property Bonoitem|null $bonoitem
 * @property Usuario $usuario
 * @property ItemBono|null $item_bono
 *
 * @package App\Models
 */
class TedefOdontoBonoitem extends Model
{
	protected $table = 'tedef_odonto_bonoitem';
	public $timestamps = false;

	protected $casts = [
		'bonoitem_id' => 'int',
		'creado_por_id' => 'int',
		'modificado_por_id' => 'int',
		'pieza_dentaria' => 'int',
		'modified_at' => 'datetime',
		'borrado_logico' => 'bool',
		'itembono_id' => 'int'
	];

	protected $fillable = [
		'bonoitem_id',
		'creado_por_id',
		'modificado_por_id',
		'pieza_dentaria',
		'superficie',
		'modified_at',
		'borrado_logico',
		'itembono_id'
	];

	public function bonoitem()
	{
		return $this->belongsTo(Bonoitem::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'creado_por_id');
	}

	public function item_bono()
	{
		return $this->belongsTo(ItemBono::class, 'itembono_id');
	}
}
