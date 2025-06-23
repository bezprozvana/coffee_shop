<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Увійти - Daily Grind</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --light: #f5f5f5;
            --light-gray: #e0e0e0;
            --medium-gray: #bdbdbd;
            --dark-gray: #616161;
            --dark: #424242;
            --black: #212121;
            --white: #ffffff;
            --accent: #757575;
            --gold: #d4af37;
            --dark-charcoal: #333333;
            --slate-gray: #708090;
            --coffee-500: #6F4E37;
            --coffee-600: #5D4037;
            --coffee-700: #4E342E;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--dark);
            background-color: var(--light);
            line-height: 1.6;
        }
        
        /* Стилі для сторінки входу */
        .login-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .login-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            background-color: var(--light);
        }
        
        .login-card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            width: 100%;
            max-width: 28rem;
            margin: 0 1rem;
        }
        
        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark-charcoal);
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .login-subtitle {
            text-align: center;
            font-size: 0.95rem;
            color: var(--dark-gray);
            margin-bottom: 2rem;
        }
        
        .login-link {
            color: var(--coffee-600);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .login-link:hover {
            color: var(--coffee-500);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: var(--white);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--coffee-500);
            box-shadow: 0 0 0 3px rgba(111, 78, 55, 0.1);
        }
        
        .remember-forgot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 0.5rem;
            accent-color: var(--coffee-600);
        }
        
        .remember-me label {
            font-size: 0.9rem;
            color: var(--dark);
        }
        
        .login-button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--coffee-600);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .login-button:hover {
            background-color: var(--coffee-700);
        }
        
        .error-message {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        /* Адаптивність */
        @media (max-width: 640px) {
            .login-card {
                padding: 1.5rem;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Хедер -->
    @include('layouts.header')

    <div class="login-container">
        <main class="login-content">
            <div class="login-card">
                <div class="text-center">
                    <h1 class="login-title">Увійти в акаунт</h1>
                    <p class="login-subtitle">
                        Або <a href="{{ route('register') }}" class="login-link">зареєструвати новий акаунт</a>
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form class="mt-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="form-input"
                            value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Пароль</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="form-input">
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                    </div>

                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input id="remember_me" name="remember" type="checkbox">
                            <label for="remember_me">Запам'ятати мене</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="login-link text-sm">
                                Забули пароль?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="login-button">
                        Увійти
                    </button>
                </form>
            </div>
        </main>
    </div>

    <!-- Футер -->
    @include('layouts.footer')
</body>
</html>