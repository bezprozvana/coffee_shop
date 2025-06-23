<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація - Coffee Shop</title>
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
        
        /* Стилі для сторінки реєстрації */
        .register-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .register-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            background-color: var(--light);
        }
        
        .register-card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            width: 100%;
            max-width: 28rem;
            margin: 0 1rem;
        }
        
        .register-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark-charcoal);
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .register-subtitle {
            text-align: center;
            font-size: 0.95rem;
            color: var(--dark-gray);
            margin-bottom: 2rem;
        }
        
        .register-link {
            color: var(--coffee-600);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .register-link:hover {
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
        
        .register-button {
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
            margin-top: 1rem;
        }
        
        .register-button:hover {
            background-color: var(--coffee-700);
        }
        
        .error-message {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        /* Адаптивність */
        @media (max-width: 640px) {
            .register-card {
                padding: 1.5rem;
            }
            
            .register-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Хедер -->
    @include('layouts.header')

    <div class="register-container">
        <main class="register-content">
            <div class="register-card">
                <div class="text-center">
                    <h1 class="register-title">Реєстраціят</h1>
                    <p class="register-subtitle">
                        Вже маєте акаунт? <a href="{{ route('login') }}" class="register-link">Увійти</a>
                    </p>
                </div>

                <form class="mt-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Ім'я</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="form-input"
                            value="{{ old('name') }}">
                        <x-input-error :messages="$errors->get('name')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="form-input"
                            value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Пароль</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="form-input">
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Підтвердіть пароль</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                            class="form-input">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                    </div>

                    <button type="submit" class="register-button">
                        Зареєструватися
                    </button>
                </form>
            </div>
        </main>
    </div>

    <!-- Футер -->
    @include('layouts.footer')
</body>
</html>