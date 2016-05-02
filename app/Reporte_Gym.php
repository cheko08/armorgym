<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Reporte_Gym extends Model
{
  protected $table = 'reportes_gym';
  protected $fillable = [
  'user_id', 'sucursal_id', 'concepto',
  'costo','caja', 'miembro_id','fecha'];

  public function user()
  {
    return $this->belongsTo('App\User')->withTrashed();
  }

    public function miembro()
  {
    return $this->belongsTo('App\Miembro')->withTrashed();
  }

  public function sucursal()
  {
    return $this->belongsTo('App\Sucursal');
  }

}