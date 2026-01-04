# ImpactHub - Event Management Platform

Platform manajemen event berbasis web yang dibangun menggunakan Laravel 12, dirancang untuk mengelola event, registrasi peserta, pembayaran, dan sertifikat digital.

## Daftar Isi

- [Tentang Project](#tentang-project)
- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Database Schema](#database-schema)
- [Struktur Project](#struktur-project)
- [Roles & Permissions](#roles--permissions)
- [API Routes](#api-routes)
- [Testing](#testing)
- [Deployment](#deployment)

## Tentang Project

ImpactHub adalah platform manajemen event yang memungkinkan organizer membuat dan mengelola event, sementara participant dapat mendaftar, membayar, dan mendapatkan sertifikat digital. Platform ini dilengkapi dengan sistem pembayaran terintegrasi (Midtrans), sistem poin reward, dan dashboard analytics untuk admin.

## Fitur Utama

### Untuk Admin
- Dashboard analytics dengan statistik lengkap (users, events, revenue, registrations)
- Manajemen user (create, update, delete, role assignment)
- Monitoring semua event dengan approval system
- Report & analytics (revenue trends, user growth, event statistics)
- System settings & maintenance (cache management, optimization)

### Untuk Organizer
- Membuat dan mengelola event (CRUD operations)
- Upload gambar event dan gallery
- Mengatur jadwal event (event schedules)
- Mengelola materi event (event materials)
- Monitoring registrasi peserta
- Approve/reject registrasi
- Generate sertifikat untuk peserta
- Dashboard statistik event pribadi

### Untuk Participant
- Browse dan search event berdasarkan kategori
- Registrasi event (free & paid)
- Tracking status registrasi
- Mendapatkan sertifikat digital
- Sistem poin reward
- Riwayat transaksi dan event

### Fitur Umum
- Authentication & Authorization (Laravel Breeze)
- Role-based access control (Admin, Organizer, Participant)
- Soft delete untuk data protection
- Image upload & storage management
- Email notifications
- Responsive design dengan Tailwind CSS
- Custom ocean color palette untuk branding

## Teknologi

### Backend
- **Laravel Framework**: 12.x
- **PHP**: 8.2+
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Payment Gateway**: Midtrans PHP SDK
- **Permissions**: Spatie Laravel Permission

### Frontend
- **Tailwind CSS**: 3.x untuk styling
- **Alpine.js**: JavaScript framework (via Breeze)
- **Blade**: Template engine
- **Vite**: Asset bundling

### Development Tools
- **Composer**: Dependency management
- **NPM**: Package management
- **Laravel Pint**: Code formatting
- **PHPUnit**: Testing framework
- **Faker**: Test data generation

## Persyaratan Sistem

- PHP >= 8.2
- Composer >= 2.0
- Node.js >= 18.x
- NPM >= 9.x
- MySQL >= 8.0
- Apache/Nginx web server
- XAMPP/WAMP/Laragon (untuk development lokal)

### PHP Extensions Required
- OpenSSL
- PDO
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo
- GD

## Instalasi

### 1. Clone Repository
```bash
git clone 
cd impacthub
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create database
mysql -u root -p
CREATE DATABASE impacthub;
exit;

# Run migrations
php artisan migrate

# Seed database dengan data contoh
php artisan db:seed
```

### 5. Storage Link
```bash
# Create symbolic link untuk storage
php artisan storage:link
```

### 6. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Run Application
```bash
# Menggunakan Laravel development server
php artisan serve

# Atau menggunakan XAMPP/WAMP
# Akses via: http://localhost/laravel/impacthub/public
```

## Konfigurasi

### Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=impacthub
DB_USERNAME=root
DB_PASSWORD=
```

### Midtrans Payment Gateway
```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### Mail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Application Settings
```env
APP_NAME="ImpactHub"
APP_ENV=local
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://localhost:8000
```

## Database Schema

### Users Table
```sql
- id (PK)
- name
- email (unique)
- password
- role (enum: admin, organizer, participant)
- phone
- bio
- avatar
- is_verified
- is_active
- email_verified_at
- remember_token
- timestamps
```

### Events Table
```sql
- id (PK)
- user_id (FK -> users.id)
- category_id (FK -> categories.id)
- event_type_id (FK -> event_types.id)
- title
- slug (unique)
- description
- objectives
- requirements
- price
- quota
- registered_count
- location
- venue_type (enum: online, offline, hybrid)
- meeting_link
- image
- gallery (json)
- status (enum: draft, published, ongoing, completed, cancelled)
- start_date
- end_date
- registration_deadline
- instructor_info
- is_featured
- certificate_available
- points_reward
- timestamps
- soft_deletes
```

### Categories Table
```sql
- id (PK)
- name (unique)
- slug (unique)
- description
- icon
- is_active
- timestamps
```

### Event Types Table
```sql
- id (PK)
- name (unique)
- slug (unique)
- description
- timestamps
```

### Registrations Table
```sql
- id (PK)
- event_id (FK -> events.id)
- user_id (FK -> users.id)
- registration_code (unique)
- status (enum: pending, confirmed, cancelled, refunded)
- notes
- cancellation_reason
- cancelled_at
- timestamps
- unique(event_id, user_id)
```

### Transactions Table
```sql
- id (PK)
- registration_id (FK -> registrations.id)
- user_id (FK -> users.id)
- transaction_code (unique)
- amount
- platform_fee
- organizer_amount
- payment_method (enum: dana, ovo, gopay, bank_transfer, credit_card)
- status (enum: pending, paid, failed, refunded)
- payment_proof
- paid_at
- expired_at
- payment_response (json)
- timestamps
```

### Certificates Table
```sql
- id (PK)
- user_id (FK -> users.id)
- event_id (FK -> events.id)
- registration_id (FK -> registrations.id)
- certificate_code (unique)
- certificate_url
- issued_at
- timestamps
- unique(user_id, event_id)
```

### User Points Table
```sql
- id (PK)
- user_id (FK -> users.id)
- points
- type (enum: earned, redeemed)
- description
- reference_type
- reference_id
- timestamps
```

### Event Schedules Table
```sql
- id (PK)
- event_id (FK -> events.id)
- title
- description
- start_time
- end_time
- location
- timestamps
```

### Event Materials Table
```sql
- id (PK)
- event_id (FK -> events.id)
- title
- description
- file_url
- file_type
- file_size
- timestamps
```

### Notifications Table
```sql
- id (PK)
- user_id (FK -> users.id)
- type
- title
- message
- action_url
- is_read
- read_at
- timestamps
```

## Struktur Project

```
impacthub/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminEventController.php
│   │   │   │   ├── ManageUserController.php
│   │   │   │   ├── ReportController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── Auth/
│   │   │   ├── DashboardController.php
│   │   │   ├── EventController.php
│   │   │   ├── RegistrationController.php
│   │   │   ├── TransactionController.php
│   │   │   └── CertificateController.php
│   │   ├── Middleware/
│   │   ├── Requests/
│   │   └── Resources/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Event.php
│   │   ├── Category.php
│   │   ├── EventType.php
│   │   ├── Registration.php
│   │   ├── Transaction.php
│   │   ├── Certificate.php
│   │   ├── UserPoint.php
│   │   ├── EventSchedule.php
│   │   ├── EventMaterial.php
│   │   └── Notification.php
│   ├── Policies/
│   │   ├── EventPolicy.php
│   │   ├── RegistrationPolicy.php
│   │   ├── TransactionPolicy.php
│   │   └── CertificatePolicy.php
│   ├── Services/
│   │   ├── EventService.php
│   │   ├── RegistrationService.php
│   │   ├── TransactionService.php
│   │   ├── CertificateService.php
│   │   └── NotificationService.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── AuthServiceProvider.php
├── config/
│   ├── app.php
│   ├── database.php
│   ├── midtrans.php
│   └── ...
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── storage/ (symlink)
│   └── build/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       │   ├── events/
│       │   ├── manage-users/
│       │   ├── reports/
│       │   └── settings/
│       ├── dashboard/
│       ├── events/
│       ├── registrations/
│       ├── transactions/
│       └── layouts/
├── routes/
│   ├── web.php
│   ├── auth.php
│   └── console.php
├── storage/
│   ├── app/
│   │   └── public/
│   │       └── events/
│   ├── framework/
│   └── logs/
├── tests/
│   ├── Feature/
│   └── Unit/
├── .env
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── README.md
```

## Roles & Permissions

### Admin
- Akses penuh ke semua fitur
- Manajemen user (CRUD, role assignment)
- Monitoring semua event
- Approve/reject event
- Analytics & reporting
- System maintenance

### Organizer
- Membuat dan mengelola event milik sendiri
- Upload gambar dan materi event
- Monitoring registrasi peserta
- Approve/reject registrasi
- Generate sertifikat
- View statistik event pribadi

### Participant
- Browse dan search event
- Registrasi event
- Melakukan pembayaran
- View riwayat registrasi dan transaksi
- Download sertifikat
- Kumpulkan poin reward

## API Routes

### Public Routes
```
GET  /                          # Homepage
GET  /events                    # Event listing
GET  /events/{slug}             # Event detail
GET  /categories/{slug}         # Events by category
```

### Authenticated Routes

#### Dashboard
```
GET  /dashboard                 # Dashboard berdasarkan role
```

#### Events (Organizer)
```
GET     /organizer/events              # List events
GET     /organizer/events/create       # Create form
POST    /organizer/events              # Store event
GET     /organizer/events/{id}         # Show event
GET     /organizer/events/{id}/edit    # Edit form
PUT     /organizer/events/{id}         # Update event
DELETE  /organizer/events/{id}         # Delete event
```

#### Registrations
```
GET     /registrations                 # User registrations
POST    /events/{id}/register          # Register to event
GET     /registrations/{id}            # Registration detail
DELETE  /registrations/{id}            # Cancel registration
```

#### Transactions
```
GET     /transactions                  # User transactions
GET     /transactions/{id}             # Transaction detail
POST    /transactions/{id}/pay         # Process payment
```

#### Certificates
```
GET     /certificates                  # User certificates
GET     /certificates/{id}/download    # Download certificate
```

### Admin Routes
```
GET     /admin/dashboard                        # Admin dashboard
GET     /admin/events                           # All events
GET     /admin/events/{id}                      # Event detail
PATCH   /admin/events/{id}/approve              # Approve event
PATCH   /admin/events/{id}/reject               # Reject event
GET     /admin/manage-users                     # User management
PATCH   /admin/manage-users/{id}/role           # Update role
DELETE  /admin/manage-users/{id}                # Delete user
GET     /admin/reports                          # Analytics
GET     /admin/settings                         # Settings
POST    /admin/settings/clear-cache             # Clear cache
POST    /admin/settings/optimize                # Optimize app
```

## Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/EventTest.php

# Run with coverage
php artisan test --coverage
```

### Seeding Test Data
```bash
# Seed database dengan data testing
php artisan db:seed

# Refresh database dan seed
php artisan migrate:fresh --seed
```

### Default Users (dari seeder)
```
Admin:
Email: admin@impacthub.com
Password: password

Organizer:
Email: organizer@impacthub.com
Password: password

Participant:
Email: participant@impacthub.com  (register terlebih dahulu)
Password: password
```

## Deployment

### Production Checklist

1. **Environment Configuration**
```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Database Migration**
```bash
php artisan migrate --force
```

3. **Optimize Application**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

4. **Storage Permission**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

5. **Build Assets**
```bash
npm run build
```

6. **SSL Certificate**
- Pastikan menggunakan HTTPS untuk production
- Configure SSL certificate di web server

7. **Backup Strategy**
- Setup automated database backup
- Configure file backup untuk storage/app

### Server Requirements

**Recommended Specifications:**
- CPU: 2+ cores
- RAM: 4GB minimum
- Storage: 20GB+ SSD
- Bandwidth: 100Mbps+

**Web Server Configuration:**
- Apache dengan mod_rewrite enabled
- Atau Nginx dengan proper rewrite rules
- PHP-FPM untuk better performance

## Troubleshooting

### Common Issues

**1. Permission Denied**
```bash
chmod -R 775 storage bootstrap/cache
```

**2. Mix Manifest Not Found**
```bash
npm run build
```

**3. Class Not Found**
```bash
composer dump-autoload
php artisan clear-compiled
```

**4. Database Connection Error**
- Cek kredensial database di `.env`
- Pastikan MySQL service running

**5. Image Upload Failed**
```bash
php artisan storage:link
chmod -R 775 storage/app/public
```

## Maintenance

### Cache Management
```bash
# Clear all cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Rebuild cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Database Maintenance
```bash
# Backup database
mysqldump -u root -p impacthub > backup.sql

# Restore database
mysql -u root -p impacthub < backup.sql

# Optimize tables
php artisan db:optimize
```

### Log Management
```bash
# Clear log files
php artisan log:clear

# View logs
tail -f storage/logs/laravel.log
```

## Contributing

Untuk berkontribusi pada project ini:

1. Fork repository
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

## License

Project ini menggunakan MIT License. Lihat file `LICENSE` untuk detail lebih lanjut.

## Support

Untuk pertanyaan atau bantuan, silakan hubungi:
- Email: support@impacthub.com
- Documentation: https://docs.impacthub.com

## Acknowledgments

- Laravel Framework
- Tailwind CSS
- Midtrans Payment Gateway
- Spatie Laravel Permission
- Semua contributor yang telah membantu project ini
