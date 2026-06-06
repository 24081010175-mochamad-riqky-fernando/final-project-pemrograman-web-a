<!DOCTYPE html>
< lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelan-Pelan Tapi Pastry</title>

    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        'poppins': ['Poppins', 'sans-serif'],
                        display: ['"Playfair Display"', 'serif'],
                        body:    ['Nunito', 'sans-serif'],
                    }, colors: {
                            brown: {
                            50:  '#fdf6ee',
                            100: '#f5e6d0',
                            200: '#eacba0',
                            300: '#dba96d',
                            400: '#c8873f',
                            500: '#7a4419',
                            600: '#6b3a15',
                            700: '#5a3010',
                            800: '#3d1f09',
                            900: '#2a1505',
                            }, 'pastry-brown': {
                            DEFAULT: '#8C5A3C', // Warna cokelat teks/judul
                            dark: '#4B2F2B',    // Warna cokelat tua komponen teks kanan & tombol
                            },
                            'pastry-cream': '#FFF8F0',  // Warna krem latar belakang kartu sesuai gambar
                    }
                }    
            } 
        }
    </script>

    <style>
        .stadium-clip {
            clip-path: ellipse(50% 50% at 50% 50%);
        }

        body { font-family: 'Nunito', sans-serif; }
        .modal-backdrop { backdrop-filter: blur(2px); }
        .product-row { transition: background 0.15s; }
        .product-row:hover { background: #fdf6ee; }
        .btn-icon { transition: transform 0.15s, opacity 0.15s; }
        .btn-icon:hover { transform: scale(1.15); opacity: 0.8; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.2s ease; }
        @keyframes slideDown { from { opacity:0; max-height:0; } to { opacity:1; max-height:300px; } }
        .animate-slideDown { animation: slideDown 0.25s ease; overflow:hidden; }
    </style>

</head>
