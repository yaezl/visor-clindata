<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alergia
 *
 * @property int $id
 * @property int $persona_id
 * @property string $nombre
 * @property string|null $tipo
 * @property string|null $severidad
 * @property string|null $observaciones
 * @property bool $activa
 * @property bool $borrado_logico
 * @property int|null $creado_por_id
 * @property int|null $modificado_por_id
 * @property \Carbon\Carbon $creado_en
 * @property \Carbon\Carbon|null $modificado_en
 * @property \Carbon\Carbon|null $borrado_en
 *
 * @property Persona $persona
 *
 * @package App\Models
 */
class Alergia extends Model
{
    protected $table = 'alergia';

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'modificado_en';

    protected $casts = [
        'persona_id' => 'int',
        'activa' => 'bool',
        'borrado_logico' => 'bool',
        'creado_por_id' => 'int',
        'modificado_por_id' => 'int',
        'creado_en' => 'datetime',
        'modificado_en' => 'datetime',
        'borrado_en' => 'datetime',
    ];

    protected $fillable = [
        'persona_id',
        'nombre',
        'tipo',
        'severidad',
        'observaciones',
        'activa',
        'borrado_logico',
        'creado_por_id',
        'modificado_por_id',
        'borrado_en',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}