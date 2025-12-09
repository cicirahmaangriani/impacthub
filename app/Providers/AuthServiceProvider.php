<?php

namespace App\Providers;

use App\Models\Certificate;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Transaction;
use App\Policies\CertificatePolicy;
use App\Policies\EventPolicy;
use App\Policies\RegistrationPolicy;
use App\Policies\TransactionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
        Registration::class => RegistrationPolicy::class,
        Transaction::class => TransactionPolicy::class,
        Certificate::class => CertificatePolicy::class,
    ];

    public function boot(): void
    {
        // Register policies
    }
    
}