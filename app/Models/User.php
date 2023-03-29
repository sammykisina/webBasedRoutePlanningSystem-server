<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'twoFactorCode',
        'twoFactorExpiresAt'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'twoFactorExpiresAt' =>  'datetime'
    ];

    public function generateTwoFactorCode(): void {
        $this->timestamps = false;

        $this->twoFactorCode = rand(100000, 999999);
        $this->twoFactorExpiresAt = now()->addMinutes(value: 10);
        $this->save();
    }

    public function resetTwoFactorCode() {
        $this->timestamps = false; //Dont update the 'updated_at' field yet

        $this->twoFactorCode = null;
        $this->twoFactorExpiresAt = null;
        $this->save();
    }

    public function role(): BelongsTo {
        return $this->belongsTo(
            related:Role::class,
            foreignKey: 'role_id'
        );
    }
}
