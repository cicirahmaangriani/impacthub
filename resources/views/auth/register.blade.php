<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - ImpactHub</title>
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
        
        .register-card {
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
            right: -8rem;
            width: 24rem;
            height: 24rem;
            background-color: #01162b;
            border-radius: 50%;
            opacity: 0.5;
        }
        
        .decorative-circle-2 {
            position: absolute;
            bottom: -12rem;
            left: -12rem;
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
        
        .benefits {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .benefit-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .benefit-icon {
            width: 2rem;
            height: 2rem;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .benefit-icon i {
            color: white;
            font-size: 0.875rem;
        }
        
        .benefit-text {
            font-size: 1rem;
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
            margin-bottom: 1rem;
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
        
        .login-section {
            text-align: center;
            padding-top: 0.75rem;
            margin-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .login-text {
            color: #6b7280;
            font-size: 0.875rem;
        }
        
        .login-link {
            color: #6a90b4;
            font-weight: 600;
            font-size: 0.875rem;
            margin-left: 0.25rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .login-link:hover {
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
            
            .register-card {
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
            
            .register-card {
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
    <div class="register-card">
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
                
                <h1 class="hero-title">Bergabung dengan Gerakan Perubahan Sosial</h1>
                <p class="hero-description">
                    Jadilah bagian dari komunitas changemaker terbesar di Indonesia.
                    Ikuti event, volunteer, atau kelola proyek sosial Anda sendiri.
                </p>
            </div>
            
            <div class="content benefits">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <span class="benefit-text">Gratis untuk selamanya</span>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <span class="benefit-text">Akses ke ribuan event sosial</span>
                </div>
                
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <span class="benefit-text">Daftar dalam 30 detik</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="form-section">
            <div class="form-container">
                <!-- Form Header -->
                <div class="form-header">
                    <h2 class="form-title">Buat Akun Baru</h2>
                    <p class="form-subtitle">Isi data di bawah untuk mendaftar</p>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                required 
                                autofocus 
                                autocomplete="name"
                                placeholder="John Doe"
                                class="form-input"
                            />
                        </div>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

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
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="form-input"
                            />
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input 
                                id="password_confirmation" 
                                type="password"
                                name="password_confirmation"
                                required 
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="form-input"
                            />
                        </div>
                        @error('password_confirmation')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="submit-button">
                        Daftar Sekarang
                    </button>

                    <!-- Login Link -->
                    <div class="login-section">
                        <span class="login-text">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="login-link">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>