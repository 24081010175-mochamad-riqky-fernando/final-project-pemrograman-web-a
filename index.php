<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelan-Pelan Tapi Pastry</title>

    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Petrona:ital,wght@0,100..900;1,100..900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'petrona': ['Petrona', 'petrona'],
                        'sans': ['Poppins', 'sans-petrona'],
                    }
                }
            }
        }
    </script>

<body class="bg-[#F6F1EB] font-sans">
    <nav
        class="sticky top-0 z-50 bg-[#8C5A3C] shadow-md shadow-black/50 text-white px-6 py-3 flex items-center justify-between ">
        <div class="flex items-center space-x-3">
            <img src="assets/images/logo.png" alt="Croissant Logo" class="w-12 h-12 object-contain drop-shadow-md">

            <div class="font-poppins font-semibold text-sm tracking-wide">
                PELAN-PELAN TAPI <i class="font-petrona italic font-bold text-[#FFF8F0]">Pastry</i>
            </div>
        </div>


        <div class="flex items-center  space-x-6 text-sm font-medium -ml-60">
            <a href="index.php"
                class="text-[#FFF8F0] border-b-2 border-[#FFF8F0] pb-1 transition-all duration-150">Beranda</a>
            <a href="catalog.php"
                class="hover:text-[#FFF8F0] pb-1 transition-all duration-200 opacity-80 hover:opacity-100">Katalog</a>
            <a href="manajemen.php"
                class="hover:text-[#FFF8F0] pb-1 transition-all duration-200 opacity-80 hover:opacity-100">Manajemen</a>
        </div>

        <div class="w-9 h-9 rounded-full bg-[#FFF8F0] flex items-center justify-center cursor-pointer hover:opacity-90 transition-opacity">
            <a href="login.php">👤</a>
        </div>
    </nav>

    <section class="max-w-7xl mx-auto px-6 py-12 md:py-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 max-w-xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#4B2F2B] font-petrona italic leading-[1.15]">
                Seni Menikmati Rasa Tanpa Tergesa.
            </h1>
            <p class="text-sm md:text-base text-[#4B2F2B] leading-relaxed text-justify">
                Pelan-pelan Tapi Pastry adalah ruang di mana rasa dan waktu berpadu. Kami mengurasi bahan-bahan terbaik
                dan mengolahnya lewat keahlian tangan manual untuk menciptakan artisan pastry yang jujur. Dedikasi kami
                sederhana: memberikanmu alasan untuk duduk sejenak, menarik napas, dan menikmati momen lewat kelembutan
                cita rasa yang tertinggi.
            </p>
            <button
                class="bg-[#4B2F2B] text-white px-6 py-3.5 rounded-xl font-medium flex items-center gap-2 hover:bg-[#392421] transition-all shadow-lg hover:shadow-xl active:scale-98 group">
                <span>Lihat Katalog</span>
                <span class="transform transition-transform group-hover:translate-x-1">→</span>
            </button>
        </div>

        <div class="flex justify-center lg:justify-end">
            <div
                class="relative p-4 bg-[#F4EEDC] rounded-[40px] drop-shadow-xl border border-white/60 backdrop-blur-sm max-w-md md:max-w-lg rotate-[-1deg] transition-all duration-300 ease-in-out hover:rotate-0 hover:scale-[1.03] hover:drop-shadow-2xl">
                <img src="assets/images/almond-croissant.jpg" alt="Almond Croissant"
                    class="rounded-[32px] w-full h-auto object-cover shadow-inner">
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-[#4B2F2B]/25 to-transparent"></div>
    </div>


    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-3xl md:text-4xl font-extrabold text-[#4B2F2B] font-petrona italic text-center mb-12">
            Best Seller Product
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="bg-white/60 rounded-[32px] p-5 shadow-md border border-orange-50/50 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <div class="w-full h-52 rounded-[24px] overflow-hidden mb-4">
                    <img src="assets/images/matcha-cookies.jpg" alt="Matcha Cookies"
                        class="w-full h-full object-cover">
                </div>
                <h3 class="font-petrona italic text-xl font-bold text-[#4B2F2B] mb-2">Matcha Cookies</h3>
                <p class="text-xs text-[#4B2E2B] leading-relaxed mb-5 flex-1 max-w-[240px]">
                    Perpaduan sempurna cookies yang lembut dengan rasa matcha yang kaya, memberikan sensasi manis dan sedikit pahit yang memanjakan lidah di setiap gigitan.
                </p>
                <button
                    class="bg-[#8C5A3C] text-white rounded-full py-2 px-10 text-sm font-semibold shadow-sm hover:bg-[#734A31] transition-all active:scale-95">
                    Detail
                </button>
            </div>

            <div
                class="bg-white/60 rounded-[32px] p-5 shadow-md border border-orange-50/50 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <div class="w-full h-52 rounded-[24px] overflow-hidden mb-4">
                    <img src="assets/images/almond-croissant.jpg" alt="Almond Croissant"
                        class="w-full h-full object-cover">
                </div>
                <h3 class="font-petrona italic text-xl font-bold text-[#4B2F2B] mb-2">Almond Croissant</h3>
                <p class="text-xs text-[#4B2E2B] leading-relaxed mb-5 flex-1 max-w-[240px]">
                    Pastry Prancis yang kaya akan rasa almond yang lezat, dengan tekstur yang renyah di luar dan lembut di dalam.
                    kenyamanan di setiap gigitan.
                </p>
                <button
                    class="bg-[#8C5A3C] text-white rounded-full py-2 px-10 text-sm font-semibold shadow-sm hover:bg-[#734A31] transition-all active:scale-95">
                    Detail
                </button>
            </div>

            <div
                class="bg-white/60 rounded-[32px] p-5 shadow-md border border-orange-50/50 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md">
                <div class="w-full h-52 rounded-[24px] overflow-hidden mb-4">
                    <img src="assets/images/strawberry-cheesecake.jpg" alt="Strawberry Cheesecake"
                        class="w-full h-full object-cover">
                </div>
                <h3 class="font-petrona italic text-xl font-bold text-[#4B2F2B] mb-2">Strawberry Cheesecake</h3>
                <p class="text-xs text-[#4B2E2B] leading-relaxed mb-5 flex-1 max-w-[240px]">
                    Kue keju yang lembut dengan lapisan strawberry yang segar, memberikan sensasi manis dan asam yang seimbang di setiap gigitan.
                    kaya rasa butter di dalam.
                </p>
                <button
                    class="bg-[#8C5A3C] text-white rounded-full py-2 px-10 text-sm font-semibold shadow-sm hover:bg-[#734A31] transition-all active:scale-95">
                    Detail
                </button>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-[#4B2F2B]/25 to-transparent"></div>
    </div>

    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-3xl md:text-4xl font-extrabold text-[#4B2F2B] font-petrona italic text-center mb-12">
            Mengapa Harus Memilih Kami?
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="bg-white rounded-[32px] p-8 shadow-md border border-gray-100/60 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md items-center text-center min-h-[340px]">
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mb-6 text-4xl">
                    🐌
                </div>
                <h3 class="font-petrona font-bold text-lg text-[#4B2F2B] mb-3 max-w-[220px] leading-snug">
                    Prosesnya Pelan-Pelan, Kualitasnya Past(ry)
                </h3>
                <p class="text-xs text-[#4B2E2B] leading-relaxed max-w-[250px]">
                    Menciptakan ratusan lapisan flaky butuh kesabaran. Kami merawat adonan pelan-pelan demi tekstur yang
                    sempurna di setiap gigitan.
                </p>
            </div>

            <div
                class="bg-white rounded-[32px] p-8 shadow-md border border-gray-100/60 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md items-center text-center min-h-[340px]">
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mb-6 text-4xl">
                    🌾
                </div>
                <h3 class="font-petrona font-bold text-lg text-[#4B2F2B] mb-3 max-w-[220px] leading-snug">
                    Premium Tanpa Jalan Pintas
                </h3>
                <p class="text-xs text-[#4B2E2B] leading-relaxed max-w-[250px]">
                    Kue kering legendaris dengan tekstur soft-chewy dan taburan chocolate chips melimpah yang memberikan
                    kenyamanan di setiap gigitan.
                </p>
            </div>

            <div
                class="bg-white rounded-[32px] p-8 shadow-md border border-gray-100/60 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-md items-center text-center min-h-[340px]">
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mb-6 text-4xl">
                    ☕
                </div>
                <h3 class="font-petrona font-bold text-lg text-[#4B2F2B] mb-3 max-w-[220px] leading-snug">
                    Jeda di Dunia yang Terburu-buru
                </h3>
                <p class="text-xs text-[#4B2E2B] leading-relaxed max-w-[250px]">
                    Pastry kami hadir sebagai alasan untukmu rehat sejenak. Ambil kopi favoritmu, dan mari nikmati hari
                    pelan-pelan.
                </p>
            </div>
        </div>
    </section>
</body>

<div class="max-w-7xl mx-auto px-6 py-6">
        <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-[#4B2F2B]/25 to-transparent"></div>
    </div>

<footer class="bg-[#4B2E2B]  text-white mt-16">
    <div class="max-w-7xl mx-auto px-10 py-10 shadow-[-25px_-25px_-25px_25px_#4B2F2B]">
        <div class="grid md:grid-cols-2 gap-10">
            <div>
                <h3 class="font-petrona font-bold text-3xl mb-3"><i>Kunjungi Dapur Kami</i></h3>
                <p class="text-sm text-gray-300">Datang dan rasakan aroma dari panggangan kue <br> langsung dari
                    oven
                    kami setiap hari.</p>
                <div class="mt-4 text-sm text-gray-300 leading-relaxed">
                    <b>Alamat</b>: Jl. Rungkut Asri Tengah V No. 22<br>
                    <b>Email</b>: pelanpelantapipastry@gmail.com<br>
                    <b>WhatsApp</b>: 0858-4760-5587
                </div>
            </div>
            <div class="md:justify-self-end w-full md:w-[350px]">
                <h3 class="font-petrona italic font-bold text-3xl text-[#C08552] mb-2 pb-2 border-b border-white/20">
                    Jam Operasional
                </h3>

                <div class="space-y-2 mt-3 font-sans text-sm text-gray-300">
                    <div class="flex justify-between items-center">
                        <span>Senin-Jum'at</span>
                        <span class="font-medium">08.00-20.00</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span>Sabtu-Minggu</span>
                        <span class="font-medium">06.30-16.00</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-white/20 mt-8 pt-4 text-center text-xs text-gray-400">
            © 2026 Pelan-Pelan Tapi Pastry. All Rights Reserved.
        </div>
    </div>
</footer>


</html>