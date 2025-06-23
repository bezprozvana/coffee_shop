<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профіль користувача - Coffee Shop</title>
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
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--dark);
            background-color: var(--light);
            line-height: 1.6;
        }
        
        .profile-container {
            min-height: 100vh;
            padding: 2rem 0;
            background-color: var(--light);
        }
        
        .profile-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5%;
        }
        
        .profile-card {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        
        .profile-header {
            background-color: var(--dark-charcoal);
            padding: 1.5rem 2rem;
            color: var(--white);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .profile-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .profile-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            padding: 2rem;
        }
        
        @media (min-width: 768px) {
            .profile-content {
                grid-template-columns: 2fr 1fr;
            }
        }
        
        .info-section {
            background-color: var(--light);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 500;
            color: var(--black);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .user-info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        @media (min-width: 640px) {
            .user-info-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        .info-item {
            margin-bottom: 1rem;
        }
        
        .info-label {
            font-size: 0.85rem;
            color: var(--dark-gray);
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            font-weight: 500;
            color: var(--black);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 30px;
            transition: all 0.3s ease;
            text-decoration: none;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--dark-charcoal);
            color: var(--white);
        }
        
        .btn-primary:hover {
            background-color: var(--black);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-logout {
            background: none;
            color: var(--light-gray);
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }
        
        .btn-logout:hover {
            color: var(--white);
        }
        
        .quick-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .quick-link {
            display: flex;
            align-items: center;
            padding: 1rem;
            background-color: var(--light);
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--black);
            border: 1px solid var(--light-gray);
        }
        
        .quick-link:hover {
            background-color: var(--white);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transform: translateY(-2px);
        }
        
        .link-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-gray);
            border-radius: 8px;
            margin-right: 1rem;
            color: var(--dark);
        }
        
        .link-text {
            flex-grow: 1;
        }
        
        .link-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .link-description {
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        .empty-message {
            color: var(--dark-gray);
            font-style: italic;
            padding: 1rem 0;
        }
        
        @media (max-width: 768px) {
            .profile-title {
                font-size: 1.5rem;
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .profile-header {
                padding: 1rem;
            }
            
            .profile-content {
                padding: 1.5rem;
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="antialiased">
    @include('layouts.header')

    <main class="profile-container">
        <div class="profile-wrapper">
            <div class="profile-card">
                <div class="profile-header">
                    <h1 class="profile-title">
                        Мій профіль
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-logout flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Вийти
                            </button>
                        </form>
                    </h1>
                </div>
                
                <div class="profile-content">
                    <div>
                        <div class="info-section">
                            <h2 class="section-title">Особиста інформація</h2>
                            <div class="user-info-grid">
                                <div class="info-item">
                                    <div class="info-label">Ім'я</div>
                                    <div class="info-value">{{ $user->name }}</div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Email</div>
                                    <div class="info-value">{{ $user->email }}</div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Телефон</div>
                                    <div class="info-value">{{ $user->phone_number ?? 'Не вказано' }}</div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Дата реєстрації</div>
                                    <div class="info-value">{{ $user->created_at->format('d.m.Y') }}</div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                    Редагувати профіль
                                </a>
                            </div>
                        </div>
                        
<div class="info-section">
    <h2 class="section-title">Останні замовлення</h2>
    @if($user->orders->isEmpty())
        <p class="empty-message">У вас ще немає замовлень</p>
    @else
        <div class="flex flex-col gap-4 md:flex-row md:gap-4">
            @foreach($user->orders()->with('status')->latest()->take(3)->get() as $order)
            <div class="flex-1 border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow bg-white">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-medium">Замовлення</h3>
                    <span class="px-2 py-1 rounded-full text-xs 
                        @if($order->status->name === 'Очікує') bg-yellow-100 text-yellow-800
                        @elseif($order->status->name === 'Обробляється') bg-blue-100 text-blue-800
                        @elseif($order->status->name === 'Відправлено') bg-purple-100 text-purple-800
                        @elseif($order->status->name === 'Доставлено') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $order->status->name }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-2">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                <p class="font-bold">{{ number_format($order->total_amount, 0, '', ' ') }} грн</p>
                <a href="{{ route('orders.show', $order) }}" class="inline-block mt-2 text-sm text-gray-900 font-medium hover:text-gray-700 transition-colors">
                    Детальніше
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{ route('profile.orders') }}" class="text-gray-900 font-medium hover:text-gray-700 transition-colors">
                Переглянути всі замовлення →
            </a>
        </div>
    @endif
</div>

                    </div>
                    
                    <div class="quick-links">
                        <a href="{{ route('profile.orders') }}" class="quick-link">
                            <div class="link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="link-text">
                                <div class="link-title">Мої замовлення</div>
                                <div class="link-description">Історія ваших покупок</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('profile.addresses') }}" class="quick-link">
                            <div class="link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="link-text">
                                <div class="link-title">Мої адреси</div>
                                <div class="link-description">Адреси доставки</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('wishlist.index') }}" class="quick-link">
                            <div class="link-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <div class="link-text">
                                <div class="link-title">Список бажаного</div>
                                <div class="link-description">Збережені товари</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>