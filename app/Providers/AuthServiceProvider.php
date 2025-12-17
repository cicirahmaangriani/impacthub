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
use Illuminate\Support\Facades\Gate;

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
        $this->registerPolicies();

        /**
         * ROLE GATES
         * Pastikan kolom role di tabel users berisi: admin / organizer / participant
         */
        Gate::define('isAdmin', function ($user) {
            return ($user->role ?? null) === 'admin';
        });

        Gate::define('isOrganizer', function ($user) {
            return ($user->role ?? null) === 'organizer';
        });

        Gate::define('isParticipant', function ($user) {
            return ($user->role ?? null) === 'participant';
        });

        /**
         * GATE UNTUK AKSES REGISTRATIONS (LIST)
         * Admin boleh lihat semua registrasi.
         * Organizer boleh lihat registrasi event miliknya (nanti filtering biasanya di controller/policy).
         */
        Gate::define('viewRegistrations', function ($user) {
            return in_array(($user->role ?? null), ['admin', 'organizer'], true);
        });
    }
}
