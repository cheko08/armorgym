<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Miembro extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    'nombre',
    'apellidos',
    'email',
    'telefono',
    'fecha_inscripcion',
    'fecha_proximo_pago',
    'status',
    'foto',
    'sucursal_id',
    'membresia_id',
    'comentarios', 
    'user_id',
    ];

    public function membresia()
    {
       return $this->belongsTo('App\Membresia')->withTrashed();
   }

   public function sucursal()
   {
       return $this->belongsTo('App\Sucursal');
   }

   public function pago()
   {
       return $this->hasMany('App\Pago');
   }

    public function asistencia()
   {
       return $this->hasMany('App\Asistencia');
   }

   public function user()
   {
       return $this->belongsTo('App\User')->withTrashed();
   }



}
