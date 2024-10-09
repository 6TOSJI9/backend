<?php
namespace App\Models;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->foreignId('clients_id')->constrained('clients')->onDelete('cascade');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }

};
class Orders extends Model
{
    use HasFactory;

    protected array $fillable = [
        'client_id',
        'service_id',
        'user_id',
        'status',
        'total_price',
    ];
    // Связь с клиентом: один заказ принадлежит одному клиенту
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Связь с услугой: один заказ связан с одной услугой
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Связь с пользователем: один заказ назначен одному пользователю
    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}


