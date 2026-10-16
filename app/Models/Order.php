<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model {
 protected $fillable=['mype_id','customer_id','code','status','total','payment_method','notes'];
 protected function casts():array{return ['total'=>'decimal:2'];}
 public function customer(){return $this->belongsTo(Customer::class);}
 public function items(){return $this->hasMany(OrderItem::class);}
}
