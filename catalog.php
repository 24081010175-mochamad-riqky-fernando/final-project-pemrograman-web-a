<?php
require_once 'config/koneksi.php';
session_start();    
include 'header.php';

// ambil query semua data produk
$kategori_terpilih = isset($_GET['kategori']) ? mysqli_real_escape_string($conn, $_GET['kategori']) : 'Semua Produk';

$query = "SELECT tabel_produk.*, tabel_kategori.nama_kategori 
          FROM tabel_produk 
          LEFT JOIN tabel_kategori ON tabel_produk.id_kategori = tabel_kategori.id_kategori";

if ($kategori_terpilih !== 'Semua Produk') {
    $query .= " WHERE tabel_kategori.nama_kategori = '$kategori_terpilih'";
    }
$result = mysqli_query($conn, $query);
?>

<body class="bg-[#F6F1EB] font-sans">

    <header>
    <nav
        class="sticky top-0 z-50 bg-[#8C5A3C] shadow-md shadow-black/50 text-white px-6 py-3 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="assets/images/logo.png" alt="Croissant Logo" class="w-12 h-12 object-contain drop-shadow-md">

            <div class="font-poppins font-semibold text-sm tracking-wide">
                PELAN-PELAN TAPI <i class="font-petrona italic font-bold text-[#FFF8F0]">Pastry</i>
            </div>
        </div>


        <div class="flex items-center  space-x-6 text-sm font-medium -ml-60">
            <a href="index.php"
                class="hover:text-[#FFF8F0] pb-1 transition-all duration-200 opacity-80 hover:opacity-100">Beranda</a>
                <a href="catalog.php"
                class="text-[#FFF8F0] border-b-2 border-[#FFF8F0] pb-1 transition-all duration-150">Katalog</a>
            <a href="manajemen.php"
                class="hover:text-[#FFF8F0] pb-1 transition-all duration-200 opacity-80 hover:opacity-100">Manajemen</a>
        </div>

        <div onclick="openLoginModal()" class="w-9 h-9 rounded-full bg-[#FFF8F0] flex items-center justify-center cursor-pointer hover:opacity-90 transition-opacity">
            <span class="text-base">👤</span>
        </div>
    </nav>
    </header>

    <section class="relative w-full shadow-md shadow-black/50 min-h-[500px] bg-[#3D251E] overflow-visible">
        <div class="absolute top-0 right-0 w-2/3 h-full pointer-events-none">
            <img src="assets/images/header-img.png" alt="Drip Background" class="w-5/6 object-contain object-right-top ml-auto">
        </div>

        <div class="container mx-auto px-12 pt-24 pb-32 relative z-10">
            <div class="max-w-xl ml-8 md:ml-16">
                <h1 class="text-white font-bold text-4xl md:text-5xl font-petrona italic leading-tight mb-4">
                    Ketika Rasa Manis<br>Meleleh Menyentuh Hati
                </h1>

                <p class="text-gray-200 text-md leading-relaxed mb-10 max-w-md">
                    Setiap potongan menyajikan kesegaran stroberi <br>alami yang berpadu dengan tekstur kue yang lembut. Mahakarya rasa yang siap memanjakan hari Anda.
                </p>

                <a href="#target-btn" 
                class="inline-flex items-center justify-center w-auto bg-[#8C5A3C] hover:bg-[#724930] text-white font-poppins font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 active:scale-95 text-sm cursor-pointer">
                    <span>Cari tahu lebih banyak</span>
                </a>
            </div>

            
        </div>

        <div class="absolute bottom-0 left-0 w-full translate-y-[80%] z-10">
            <svg viewBox="0 0 1440 150" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path
                    d="M0 0H1440V40 C1440 40 1410 130 1380 130 C1350 130 1320 40 1290 40 C1260 40 1230 150 1200 150 C1170 150 1140 40 1110 40 C1080 40 1050 110 1020 110 C990 110 960 40 930 40 C900 40 870 140 840 140 C810 140 780 40 750 40 C720 40 690 120 660 120 C630 120 600 40 570 40 C540 40 510 150 480 150 C450 150 420 40 390 40 C360 40 330 100 300 100 C270 100 240 40 210 40 C180 40 150 140 120 140 C90 140 60 40 30 40 C10 40 0 80 0 80 V0Z"
                    fill="#3D251E" />
            </svg>
        </div>
    </section>

    <div class="h-40"></div>

    <div class="wave-top"></div>

    <section id="target-btn" class="max-w-7xl mx-auto px-6 py-8">

        <div class="grid grid-cols-3 items-center mb-12 relative w-full">

    <button id="dropdownBtn"
        class="border-2 border-[#8C5A3C] rounded-2xl px-6 py-2.5 bg-transparent text-sm font-medium text-[#4B2F2B] flex items-center justify-between gap-4 min-w-[180px] shadow-sm hover:bg-[#FFF8F0] transition-all duration-200 focus:outline-none">
        <span id="selectedLabel"><?php echo htmlspecialchars($kategori_terpilih); ?></span>
        <svg class="w-4 h-4 text-[#8C5A3C] transition-transform duration-200" id="dropdownArrow" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div id="dropdownMenu"
        class="hidden absolute left-0 mt-3 w-64 bg-[#FFF8F0] rounded-3xl shadow-xl border border-[#E5D3C0] p-5 z-50 transition-all duration-200">
        <h4 class="text-base font-bold text-[#4B2F2B] font-petrona tracking-wide">Menu Pilihan</h4>
        <p class="text-xs italic text-gray-400 mb-3">Kategori</p>

        <ul class="space-y-1">

            <li class="dropdown-item flex items-center justify-between bg-[#FFF8F0] text-[#4B2F2B] font-semibold px-4 py-2.5 rounded-xl cursor-pointer text-sm transition-all hover:opacity-90"
                data-value="Semua Produk">
                <a href="catalog.php?kategori=Semua+Produk" class="flex items-center justify-between w-full">
                    <span>Semua Produk</span>
                    <?php if ($kategori_terpilih == 'Semua Produk') : ?>
                        <span class="checkmark text-xs font-bold text-[#8C5A3C]">✓</span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="dropdown-item flex items-center justify-between bg-[#FFF8F0] text-[#4B2F2B] font-semibold px-4 py-2.5 rounded-xl cursor-pointer text-sm transition-all hover:opacity-90"
                data-value="Croissant dan Danish">
                <a href="catalog.php?kategori=Croissant%20dan%20Danish" class="flex items-center justify-between w-full">
                    <span>Croissant dan Danish</span>
                    <?php if ($kategori_terpilih == 'Croissant dan Danish') : ?>
                        <span class="checkmark text-xs font-bold text-[#8C5A3C]">✓</span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="dropdown-item flex items-center justify-between bg-[#FFF8F0] text-[#4B2F2B] font-semibold px-4 py-2.5 rounded-xl cursor-pointer text-sm transition-all hover:opacity-90"
                data-value="Cakes">
                <a href="catalog.php?kategori=Cakes" class="flex items-center justify-between w-full">
                    <span>Cakes</span>
                    <?php if ($kategori_terpilih == 'Cakes') : ?>
                        <span class="checkmark text-xs font-bold text-[#8C5A3C]">✓</span>
                    <?php endif; ?>
                </a>
            </li>

            <li class="dropdown-item flex items-center justify-between bg-[#FFF8F0] text-[#4B2F2B] font-semibold px-4 py-2.5 rounded-xl cursor-pointer text-sm transition-all hover:opacity-90"
                data-value="Soft Cookies">
                <a href="catalog.php?kategori=Soft%20Cookies" class="flex items-center justify-between w-full">
                    <span>Soft Cookies</span>
                    <?php if ($kategori_terpilih == 'Soft Cookies') : ?>
                        <span class="checkmark text-xs font-bold text-[#8C5A3C]">✓</span>
                    <?php endif; ?>
                </a>
            </li>

        </ul>
    </div>
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl text-[#4B2F2B] font-petrona font-bold tracking-wide drop-shadow-[0_2px_3px_rgba(0,0,0,0.30)]">
                    Produk Kami
                </h2>
            </div>

            <div></div>
        </div>

<!-- looping produk -->
 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php 
            // 3. Looping data dari database menggunakan while loop
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { 
            ?>
                <div class="bg-white rounded-[32px] shadow-md border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-xl flex flex-col">
                    
                    <div class="relative w-full h-52 rounded-[24px] overflow-hidden">
                        <img src="assets/product/<?php echo $row['foto_produk']; ?>" alt="<?php echo $row['nama_produk']; ?>" class="w-full h-full object-cover">
                        
                        <span class="absolute top-3 right-3 text-xs font-semibold px-3 py-1 rounded-full <?php echo $row['status_po'] == 'Ready' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800'; ?>">
                            <?php echo $row['status_po']; ?>
                        </span>
                    </div>

                    <div class="px-4 pt-2 pb-4 flex-1 flex flex-col justify-between">
                        <div class="flex justify-between items-baseline mb-1">
                            <span class="text-xs uppercase font-semibold text-pastry-caramel tracking-wider">
                                <?php echo $row['nama_kategori']; ?>
                            </span>
                            <span class="text-xs text-gray-400 italic">Stok: <?php echo $row['stok']; ?></span>
                        </div>
                        <h3 class="font-serif font-bold text-xl mt-1 mb-2 text-pastry-dark">
                            <?php echo $row['nama_produk']; ?>
                        </h3>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-base font-semibold text-[#8C5A3C] mb-1">
                                Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                            </span>
                        </div>
                        <button onclick="openProductModal(this)" 
                                data-nama="<?php echo htmlspecialchars($row['nama_produk']); ?>"
                                data-foto="assets/product/<?php echo $row['foto_produk']; ?>"
                                data-kategori="<?php echo htmlspecialchars($row['nama_kategori']); ?>"
                                data-status="<?php echo $row['status_po']; ?>"
                                data-harga="Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>"
                                data-stok="<?php echo $row['stok']; ?>"
                                class="w-full bg-[#8C5A3C] drop-shadow-[0_2px_3px_rgba(0,0,0,0.25)] text-white rounded-full py-2.5 text-sm font-bold shadow-md hover:bg-[#69433F] active:scale-95 transition-all duration-200 cursor-pointer">
                            Detail
                        </button>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo "<p class='col-span-3 text-center text-pastry-dark/50 italic'>Belum ada data kue di etalase.</p>";
            } 
            ?>

        </div>
    </section>

    <script>
        const dropdownBtn = document.getElementById('dropdownBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', () => {
            dropdownMenu.classList.add('hidden');
        });
    </script>

<!-- area login page -->
    <div id="loginModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-black/40 backdrop-blur-md transition-all duration-300">
    
    <div class="bg-[#FFF8F0] w-full max-w-[440px] px-10 py-12 rounded-[51px] shadow-2xl relative text-center">
        
        <button onclick="closeLoginModal()" class="absolute top-5 right-6 text-black/60 hover:text-black text-xl font-bold cursor-pointer transition-colors">
            ✕
        </button>

        <h2 class="text-[32px] font-bold text-black mb-1 font-petrona italic">Masuk Akun</h2>
        <p class="text-[15px] font-medium text-black mb-8 opacity-80">Area Admin - Pelan-pelan Tapi Pastry</p>
        
        <?php if (isset($_GET['pesan'])): ?>
            <div class="mb-6 p-3 bg-amber-50 border border-amber-200 text-amber-800 text-sm rounded-xl text-center font-medium">
                <?php 
                    if ($_GET['pesan'] == "gagal") {
                        echo "Username atau password salah!";
                    } else if ($_GET['pesan'] == "belum_login") {
                        echo "Akses ditolak! Anda harus login terlebih dahulu.";
                    } else if ($_GET['pesan'] == "logout") {
                        echo "Anda berhasil keluar dari sistem.";
                    }
                ?>
            </div>
        <?php endif; ?>

        <form action="proses_login.php" method="POST">
            <div class="mb-4 flex flex-col">
                <input type="text" name="username" id="username"
                       placeholder="Username" 
                       required 
                       class="w-full px-6 py-3.5 text-sm bg-[#C08552] text-white rounded-[25px] border-none outline-none font-medium placeholder-white/80">
            </div>
            
            <div class="mb-5 flex flex-col items-center relative w-full">
                <input type="password" name="password" 
                       id="passwordModal" 
                       placeholder="Kata Sandi" 
                       required 
                       class="w-full pl-6 pr-12 py-3.5 text-sm bg-[#C08552] text-white rounded-[25px] border-none outline-none font-medium placeholder-white/80">
                <i class="fa-regular fa-eye-slash absolute right-5 text-white/80 cursor-pointer text-base top-1/2 -translate-y-1/2" id="togglePasswordModal"></i>
            </div>
            
            <button type="submit" name="login"
                    class="w-full py-3.5 bg-[#4B2F2B] text-white rounded-[25px] text-base font-bold shadow-sm transition duration-200 hover:bg-[#392421] active:scale-[0.99] cursor-pointer">
                Masuk
            </button>
        </form>
    </div>
</div>

<script>
    const loginModal = document.getElementById('loginModal');
    const passwordModal = document.getElementById('passwordModal');
    const togglePasswordModal = document.getElementById('togglePasswordModal');

    // Fungsi Menampilkan Modal
    function openLoginModal() {
        loginModal.classList.remove('hidden');
    }

    // Fungsi Menyembunyikan Modal
    function closeLoginModal() {
        loginModal.classList.add('hidden');
    }

    // Tutup modal otomatis jika admin klik di area luar kotak form (di area blur)
    window.onclick = function(event) {
        if (event.target == loginModal) {
            closeLoginModal();
        }
    }

    // Fitur Intip Kata Sandi di dalam Modal
    togglePasswordModal.addEventListener('click', function () {
        const type = passwordModal.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordModal.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

<?php if (isset($_GET['pesan'])): ?>
<script>
    // Jika halaman memuat pesan error login, otomatis langsung munculkan kembali modalnya
    openLoginModal();
</script>
<?php endif; ?>
</body>

<?php include 'product_card.php'; ?>

<script>
    const productModal = document.getElementById('productModal');
    const modalImg = document.getElementById('modalImg');
    const modalNama = document.getElementById('modalNama');
    const modalKategori = document.getElementById('modalKategori');
    const modalStatus = document.getElementById('modalStatus');
    const modalHarga = document.getElementById('modalHarga');
    const modalStok = document.getElementById('modalStok');

    function openProductModal(button) {
    // Tarik data atribut
    const nama = button.getAttribute('data-nama');
    const foto = button.getAttribute('data-foto');
    const kategori = button.getAttribute('data-kategori');
    const status = button.getAttribute('data-status');
    const harga = button.getAttribute('data-harga');
    const stok = button.getAttribute('data-stok');

    // Suntik data ke modal
    document.getElementById('modalNama').innerText = nama;
    document.getElementById('modalImg').src = foto;
    document.getElementById('modalImg').alt = nama;
    document.getElementById('modalKategori').innerText = kategori;
    document.getElementById('modalHarga').innerText = harga; // <--- Mengisi Harga
    document.getElementById('modalStok').innerText = stok;   // <--- Mengisi Stok
    document.getElementById('modalStatus').innerText = status;

    // Atur warna teks status background melengkung bulat agar estetik sesuai desain card
    if (status === 'Ready') {
        document.getElementById('modalStatus').className = "text-[14px] font-poppins font-medium italic text-green-600 mb-2";
    } else {
        document.getElementById('modalStatus').className = "text-[14px] font-poppins font-medium italic text-amber-600 mb-3";
    }

    // Tampilkan overlay modal
    document.getElementById('productModal').classList.remove('hidden');
    }

    function closeProductModal() {
        document.getElementById('productModal').classList.add('hidden');
    }

    // Tutup otomatis jika klik area blur luar card
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('productModal');
        if (event.target == modal) {
            closeProductModal();
        }
});
</script>




<?php
include 'footer.php';
?>

