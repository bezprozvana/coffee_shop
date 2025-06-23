<footer class="bg-[#2d2d2d] text-gray-100 py-6 font-sans relative overflow-hidden">
    <div class="absolute left-4 -top-0 h-24 w-24 z-10">
        <img src="{{ asset('assets/albums/icons/logo.png') }}" alt="Coffee Shop Logo" class="h-full w-full object-contain drop-shadow-lg">
    </div>

    <div class="container mx-auto px-4 pl-28">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0 flex-1 text-center md:text-left">
                <p class="text-sm text-gray-200 font-light leading-relaxed max-w-lg mx-auto">
                    Найкраща кава з різних куточків світу. Доставка по всій Україні
                </p>
            </div>
            
            <div class="flex space-x-5">
                <a href="tel:+380123456789" class="group flex items-center">
                    <div class="bg-[#3a3a3a] group-hover:bg-[#d4a15f] rounded-full p-2.5 transition-all duration-300 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current stroke-1.5" fill="none" viewBox="0 0 24 24">
                            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm hidden md:inline font-medium text-gray-200 group-hover:text-[#d4a15f] transition-colors duration-300">+380 12 345 6789</span>
                </a>
                
                <a href="mailto:info@coffeeshop.com" class="group flex items-center">
                    <div class="bg-[#3a3a3a] group-hover:bg-[#d4a15f] rounded-full p-2.5 transition-all duration-300 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current stroke-1.5" fill="none" viewBox="0 0 24 24">
                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm hidden md:inline font-medium text-gray-200 group-hover:text-[#d4a15f] transition-colors duration-300">info@coffeeshop.com</span>
                </a>
                
                <a href="#" class="group flex items-center">
                    <div class="bg-[#3a3a3a] group-hover:bg-[#d4a15f] rounded-full p-2.5 transition-all duration-300 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current stroke-1.5" fill="none" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                            <path d="M17.5 6.5h.01"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm hidden md:inline font-medium text-gray-200 group-hover:text-[#d4a15f] transition-colors duration-300">@coffeeshop_ua</span>
                </a>
            </div>
        </div>
    </div>
</footer>