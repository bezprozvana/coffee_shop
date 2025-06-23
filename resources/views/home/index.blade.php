<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop - Головна</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
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
        
        /* Герой секція */
        .hero-section {
            height: 60vh;
            min-height: 450px;
            background-image: url('{{ asset("assets/albums/images/banner.jpg") }}');
            background-size: cover;
            background-position: center 75%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            position: relative;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
        }
        
        .hero-content {
    position: relative;
    z-index: 1;
    color: var(--white);
    padding: 0 5%;
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
        .hero-text-content {
    max-width: 600px;
}

.hero-logo {
    width: 300px;
    height: 300px;
    margin-left: 50px;
    animation: float 6s ease-in-out infinite;
}

.hero-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    filter: drop-shadow(0 5px 15px rgba(0,0,0,0.3));
}
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            letter-spacing: 1px;
            line-height: 1.2;
            max-width: 600px;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
            max-width: 500px;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .hero-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 28px;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 30px;
            transition: all 0.3s ease;
            text-decoration: none;
            text-transform: uppercase;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary {
            background-color: var(--dark-charcoal);
            color: var(--white);
            border: 2px solid var(--dark-charcoal);
        }
        
        .btn-primary:hover {
            background-color: transparent;
            color: var(--dark-charcoal);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }
        
        .btn-secondary:hover {
            background-color: rgba(255,255,255,0.1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Категорії */
        .category-slider-section {
            padding: 5rem 0;
            background-color: var(--light);
        }
        
        .category-slider-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 5%;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--black);
            letter-spacing: 1px;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background-color: var(--slate-gray);
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .section-subtitle {
            color: var(--dark-gray);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.05rem;
        }
        
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
            padding-top: 3rem;
            border-top: 1px solid var(--light-gray);
        }
        
        .category-slider-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--black);
            margin: 0;
        }
        
        .view-all-link {
            color: var(--dark-gray);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 6px 12px;
            border-radius: 4px;
        }
        
        .view-all-link:hover {
            color: var(--black);
            background-color: rgba(0,0,0,0.03);
        }
        
        .view-all-link svg {
            margin-left: 6px;
            transition: all 0.3s ease;
        }
        
        .view-all-link:hover svg {
            transform: translateX(3px);
        }
        
        /* Картки товарів */
        .products-slider {
            margin-bottom: 4rem;
            position: relative;
            padding-bottom: 40px;
        }
        
        .product-card {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
            margin: 10px;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }
        
        .product-image-container {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        
        .product-card:hover .product-image {
            transform: scale(1.08);
        }
        
        .product-info {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-country {
            font-size: 0.75rem;
            color: var(--accent);
            margin-bottom: 8px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .product-name {
            font-weight: 500;
            margin-bottom: 10px;
            font-size: 1rem;
            color: var(--black);
            flex-grow: 1;
            line-height: 1.4;
        }
        
        .product-weight {
            font-size: 0.8rem;
            color: var(--accent);
            margin-bottom: 12px;
        }
        
        .product-price {
            font-weight: 600;
            color: var(--black);
            font-size: 1.1rem;
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .product-price span {
            color: var(--slate-gray);
            font-weight: 700;
        }
        
        /* Пагінація */
        .swiper-pagination {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px 0;
        }
        
        .swiper-pagination-bullet {
            width: 8px;
            height: 8px;
            background-color: var(--medium-gray);
            opacity: 0.5;
            margin: 0 6px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .swiper-pagination-bullet-active {
            background-color: var(--slate-gray);
            opacity: 1;
            width: 12px;
            height: 12px;
        }
        
        /* Навігація */
        .swiper-button-next, .swiper-button-prev {
            color: var(--white);
            background-color: var(--dark-charcoal);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            top: 40%;
            margin-top: 0;
            opacity: 0.9;
        }
        
        .swiper-button-next {
            right: 15px;
        }
        
        .swiper-button-prev {
            left: 15px;
        }
        
        .swiper-button-next:hover, .swiper-button-prev:hover {
            background-color: var(--slate-gray);
            color: var(--white);
            opacity: 1;
            transform: scale(1.1);
        }
        
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 1rem;
            font-weight: bold;
        }
        
        /* CTA секція */
        .cta-section {
            background-color: var(--black);
            color: var(--white);
            padding: 6rem 0;
            text-align: center;
            background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)), url('{{ asset("assets/albums/images/cta-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .cta-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 5%;
        }
        
        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        
        .cta-text {
            font-size: 1.05rem;
            margin-bottom: 2.5rem;
            line-height: 1.7;
            opacity: 0.9;
            color: var(--light-gray);
        }
        
        /* Адаптивність */
        @media (max-width: 1024px) {
            .hero-title {
                font-size: 2.4rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                height: 55vh;
                min-height: 400px;
                align-items: flex-end;
                padding-bottom: 60px;
                background-position: center 65%;
            }
            
            .hero-title {
                font-size: 2rem;
                max-width: 100%;
            }
            
            .hero-subtitle {
                max-width: 100%;
                margin-bottom: 1.5rem;
            }
            
            .hero-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
                max-width: 250px;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .category-slider-title {
                font-size: 1.4rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .product-image-container {
                height: 180px;
            }
        }
        
        @media (max-width: 480px) {
            .hero-section {
                height: 50vh;
                min-height: 350px;
                padding-bottom: 40px;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.6rem;
            }
            
            .section-title:after {
                width: 40px;
                bottom: -10px;
            }
            
            .product-image-container {
                height: 160px;
            }
            
            .swiper-button-next, .swiper-button-prev {
                display: none;
            }
        }
    </style>
</head>
<body class="antialiased">
    @include('layouts.header')

    <main>
        <!-- Герой секція -->
        <section class="hero-section">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                    <div class="hero-text-content">
                <h1 class="hero-title">Вишукана кава для справжніх знавців</h1>
                <p class="hero-subtitle">Відкрийте для себе унікальні смаки кави з різних куточків світу</p>
                <div class="hero-actions">
                    <a href="{{ route('catalog') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        До каталогу
                    </a>
                    <a href="#categories" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Категорії
                    </a>
                </div>
            </div>
            <div class="hero-logo">
                <img src="{{ asset('assets/albums/icons/7.png') }}" alt="Coffee Shop Logo">
            </div>
        </div>
        </section>

        <!-- Категорії -->
        <section id="categories" class="category-slider-section">
            <div class="section-header">
                <h2 class="section-title">Наш асортимент</h2>
                <p class="section-subtitle">Оберіть каву за вашими уподобаннями з нашої колекції преміум-сортів</p>
            </div>
            
            @foreach($categories as $category)
            <div class="category-slider-container">
                <div class="category-header">
                    <h2 class="category-slider-title">{{ $category->name }}</h2>
                    <a href="{{ route('catalog.category', $category) }}" class="view-all-link">
                        Переглянути всі
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                </div>
                
                <div class="products-slider swiper">
                    <div class="swiper-wrapper">
                        @foreach($category->products->take(8) as $product)
                        <div class="swiper-slide">
                            <a href="{{ route('catalog.show', $product) }}" class="product-card">
                                <div class="product-image-container">
                                    <img src="{{ asset('assets/albums/foto/' . $product->image) }}" 
                                         alt="{{ $product->name }}" class="product-image"
                                         onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                                </div>
                                <div class="product-info">
                                    <div class="product-country">{{ $product->country->name }}</div>
                                    <h3 class="product-name">{{ $product->name }}</h3>
                                    <div class="product-weight">{{ $product->weight->name }}</div>
                                    <div class="product-price">
                                        {{ number_format($product->price, 0, '', ' ') }} грні
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            @endforeach
        </section>

        <!-- CTA секція -->
        <section class="cta-section">
            <div class="cta-container">
                <h2 class="cta-title">Приєднуйтесь до нашої кавової спільноти</h2>
                <p class="cta-text">
                    Отримуйте ексклюзивні пропозиції, дізнавайтеся про новинки першими та насолоджуйтесь 
                    спеціальними умовами для постійних клієнтів.
                </p>
                <a href="{{ route('register') }}" class="btn btn-primary" style="margin-right: 15px;">Зареєструватись</a>
                <a href="{{ route('catalog') }}" class="btn btn-secondary">Перейти до каталогу</a>
            </div>
        </section>
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ініціалізація слайдерів
            const sliders = document.querySelectorAll('.products-slider');
            
            sliders.forEach(slider => {
                new Swiper(slider, {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: slider.querySelector('.swiper-button-next'),
                        prevEl: slider.querySelector('.swiper-button-prev'),
                    },
                    pagination: {
                        el: slider.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 2,
                            spaceBetween: 15
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 20
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 25
                        }
                    }
                });
            });

            // Плавний скрол до секцій
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>