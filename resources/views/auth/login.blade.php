<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - ImpactHub</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #01162b 0%, #00385a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-card {
            display: flex;
            width: 100%;
            max-width: 1100px;
            background-color: white;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.25), 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .hero-section {
            width: 45%;
            background-color: #00385a;
            color: white;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        
        .form-section {
            width: 55%;
            background-color: white;
            padding: 3rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .decorative-circle-1 {
            position: absolute;
            top: -12rem;
            left: -12rem;
            width: 24rem;
            height: 24rem;
            background-color: #01162b;
            border-radius: 50%;
            opacity: 0.5;
        }
        
        .decorative-circle-2 {
            position: absolute;
            bottom: -12rem;
            right: -8rem;
            width: 24rem;
            height: 24rem;
            background-color: #01162b;
            border-radius: 50%;
            opacity: 0.5;
        }
        
        .content {
            position: relative;
            z-index: 10;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }
        
        .logo-box {
            width: 3rem;
            height: 3rem;
            background-color: white;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-box i {
            color: #00385a;
            font-size: 1.25rem;
        }
        
        .logo-text {
            font-size: 1.375rem;
            font-weight: bold;
        }
        
        .hero-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .hero-description {
            font-size: 1rem;
            color: #d1d5db;
            line-height: 1.6;
        }
        
        .features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .feature-card {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 0.75rem;
            padding: 1rem;
        }
        
        .feature-icon {
            width: 2.5rem;
            height: 2.5rem;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .feature-icon i {
            color: white;
            font-size: 1rem;
        }
        
        .feature-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        
        .feature-text {
            font-size: 0.8125rem;
            color: #d1d5db;
        }
        
        .form-container {
            width: 100%;
            max-width: 24rem;
        }
        
        .form-header {
            margin-bottom: 1.75rem;
        }
        
        .form-title {
            font-size: 1.75rem;
            font-weight: bold;
            color: #01162b;
            margin-bottom: 0.5rem;
        }
        
        .form-subtitle {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .form-group {
            margin-bottom: 1.125rem;
        }
        
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #01162b;
            margin-bottom: 0.5rem;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            background-color: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.9375rem;
            transition: all 0.2s;
            outline: none;
        }
        
        .form-input:focus {
            border-color: #6a90b4;
            background-color: white;
        }
        
        .form-input::placeholder {
            color: #9ca3af;
        }
        
        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.125rem;
        }
        
        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .checkbox-input {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        
        .checkbox-text {
            margin-left: 0.5rem;
            font-size: 0.875rem;
            color: #374151;
        }
        
        .forgot-link {
            font-size: 0.875rem;
            color: #6a90b4;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .forgot-link:hover {
            color: #00385a;
        }
        
        .submit-button {
            width: 100%;
            background-color: #00385a;
            color: white;
            padding: 0.8125rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            font-size: 0.9375rem;
            transition: background-color 0.2s;
        }
        
        .submit-button:hover {
            background-color: #01162b;
        }
        
        .register-section {
            text-align: center;
            padding-top: 0.75rem;
            margin-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .register-text {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .register-link {
            color: #6a90b4;
            font-weight: 600;
            font-size: 0.875rem;
            margin-left: 0.25rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .register-link:hover {
            color: #00385a;
        }
        
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        @media (max-width: 1024px) {
            body {
                padding: 1rem;
            }
            
            .login-card {
                flex-direction: column;
                max-width: 500px;
            }
            
            .hero-section {
                width: 100%;
                padding: 2rem;
            }
            
            .form-section {
                width: 100%;
                padding: 2rem;
            }
        }
        
        @media (max-width: 640px) {
            body {
                padding: 0.5rem;
            }
            
            .login-card {
                border-radius: 1rem;
            }
            
            .hero-section {
                padding: 1.5rem;
            }
            
            .form-section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Left Side - Hero Section -->
        <div class="hero-section">
            <div class="decorative-circle-1"></div>
            <div class="decorative-circle-2"></div>
            
            <div class="content">
                <div class="logo-section">
                    <div class="logo-box">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <span class="logo-text">ImpactHub</span>
                </div>
                
                <h1 class="hero-title">Selamat Datang Kembali!</h1>
                <p class="hero-description">
                    Masuk ke akun Anda untuk mengakses platform kolaborasi 
                    sosial terlengkap dan mulai membuat dampak positif bersama ImpactHub.
                </p>
            </div>
            
            <div class="content features">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <div class="feature-title">Event & Proyek Sosial</div>
                        <div class="feature-text">Ikuti atau kelola berbagai event dan proyek sosial</div>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="feature-title">Komunitas Aktif</div>
                        <div class="feature-text">Terhubung dengan ribuan changemaker dan volunteer</div>
                    </div>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div>
                        <div class="feature-title">Sertifikat & Pencapaian</div>
                        <div class="feature-text">Dapatkan pengakuan atas kontribusi sosial Anda</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="form-section">
            <div class="form-container">
                <!-- Form Header -->
                <div class="form-header">
                    <h2 class="form-title">Masuk</h2>
                    <p class="form-subtitle">Selamat datang kembali! Silakan masuk ke akun Anda</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="error-message" style="color: #059669; margin-bottom: 1rem;">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-wrapper">
                            <i class="fas fa-at input-icon"></i>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                autofocus 
                                autocomplete="username"
                                placeholder="john@example.com"
                                class="form-input"
                            />
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input 
                                id="password" 
                                type="password"
                                name="password"
                                required 
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="form-input"
                            />
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="form-row">
                        <label class="checkbox-label">
                            <input type="checkbox" id="remember_me" name="remember" class="checkbox-input">
                            <span class="checkbox-text">Ingat saya</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-button">
                        Masuk
                    </button>

                    <!-- Register Link -->
                    <div class="register-section">
                        <span class="register-text">Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="register-link">Daftar sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>