<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\OrderNotification;

class Order extends Model
{
    public $fillable = 
            [
                'user_id',
                'ip_address',
                'name',
                'phone_no',
                'payment_id',
                'shipping_address',
                'email',
                'message',
                'is_paid',
                'is_completed',
                'is_seen_by_admin',
                'transaction_id'
            ];
    public function user()
            {
                return $this->belongsTo(User::class);
            }
    public function carts()
            {
                return $this->hasMany(Cart::class);
            }
    public function payment()
            {
                return $this->belongsTo(Payment::class);
            }
    public function product()
            {
                return $this->belongsTo(Product::class);
            }
}
