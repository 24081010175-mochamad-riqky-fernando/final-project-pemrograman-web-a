<?php
// admin/dashboard.php
session_start();

// KODE SATPAM: Jika tidak ada session login atau statusnya bukan admin, tendang keluar!
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php?pesan=belum_login");
    exit;
}

// Panggil koneksi untuk mengambil ringkasan data data dummy
require_once '../config/koneksi.php';

// Ambil total produk untuk statistik di dashboard
$query_produk = mysqli_query($conn, "SELECT COUNT(*) as total FROM tabel_produk");
$data_produk = mysqli_fetch_assoc($query_produk);

// Ambil total kategori
$query_kategori = mysqli_query($conn, "SELECT COUNT(*) as total FROM tabel_kategori");
$data_kategori = mysqli_fetch_assoc($query_kategori);
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Katalog Produk — Pelan Pelan Tapi Pastry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="icon" type="image/png" href="../assets/images/favicon.png">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
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
            },
          },
          fontFamily: {
            display: ['"Playfair Display"', 'serif'],
            body:    ['Nunito', 'sans-serif'],
          },
        },
      },
    }
  </script>
  <style>
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
<body class="bg-brown-50 min-h-screen flex flex-col">

  <!-- ========== NAVBAR ========== -->
  <header>
    <nav class="sticky top-0 z-50 bg-[#8C5A3C] shadow-md shadow-black/50 text-white px-6 py-3 flex items-center justify-between ">
        <div class="flex items-center space-x-3">
            <img src="../assets/images/logo.png" alt="Croissant Logo" class="w-12 h-12 object-contain drop-shadow-md">

            <div class="font-poppins font-semibold text-sm tracking-wide">
                PELAN-PELAN TAPI <i class="font-petrona italic font-bold text-[#FFF8F0]">Pastry</i>
            </div>
        </div>


        <div class="flex items-center  space-x-6 text-sm font-medium -ml-60">
            <a href="../index.php"
                class="hover:text-[#FFF8F0] pb-1 transition-all duration-200 opacity-80 hover:opacity-100">Beranda</a>
            <a href="../catalog.php"
                class="hover:text-[#FFF8F0] pb-1 transition-all duration-200 opacity-80 hover:opacity-100">Katalog</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="katalogmanajemen.php" 
                    class="text-[#FFF8F0]  pb-1 transition-all duration-150 border-b-2 border-[#FFF8F0]">Manajemen</a>
            <?php endif; ?>
        </div>

        <div class="flex items-center space-x-4">
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="logout.php" 
                    class="bg-[#4B2F2B] text-sm text-white px-3 py-1.5 rounded-xl font-medium flex items-center gap-2 hover:bg-[#392421] transition-all shadow-lg hover:shadow-xl active:scale-98 group">Logout</a>
            <?php else: ?>
                <div onclick="openLoginModal()" 
                    class="w-9 h-9 rounded-full bg-[#FFF8F0] flex items-center justify-center cursor-pointer hover:opacity-90 transition-opacity">
                    <span class="text-base">👤</span>
                </div>
            <?php endif; ?>
        </div>    
    </nav>
  </header>

  <!-- ========== MAIN CONTENT ========== -->
  <main class="flex-1 px-6 py-5 max-w-4xl w-full mx-auto">

    <!-- Tambah Produk Button -->
  <div class="mb-4">
    <button id="btnTambah"
      onclick="toggleFormTambah();"
      class="flex items-center gap-2 bg-white border-2 border-brown-500 text-brown-600 font-bold text-sm px-4 py-2 rounded-xl hover:bg-brown-500 hover:text-white transition-all duration-200 shadow-sm outline-none">
      <span class="font-display font-semibold tracking-wide">TAMBAH PRODUK</span>
      <span id="btnTambahIcon" class="w-7 h-7 rounded-full bg-brown-500 text-white flex items-center justify-center text-lg leading-none transition">+</span>
    </button>
  </div>


  <!-- ========== FORM TAMBAH (State 2) ========== -->
<div id="formTambah" class="hidden animate-slideDown mb-5">
  <!-- Bungkus dengan tag form dan WAJIB sertakan enctype untuk upload file/gambar -->
  <form action="proses_tambah.php" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-brown-200 shadow-sm p-5">
    <p class="font-bold text-brown-700 text-sm mb-4 tracking-wide">FORM DATA PRODUK BARU</p>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3">
      <!-- 1. Nama Produk -->
      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Nama Produk</label>
        <input name="nama_produk" type="text" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50" placeholder="Contoh: Croissant Coklat" />
      </div>
      
      <!-- 2. Stok -->
      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Stok</label>
        <input name="stok" type="number" min="0" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50" placeholder="Jumlah stok" />
      </div>
      
      <!-- 3. Harga -->
      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Harga (Angka Saja)</label>
        <input name="harga" type="number" min="0" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50" placeholder="Contoh: 25000" />
      </div>
      
      <!-- 4. Kategori (Ambil dinamis dari database agar sinkron dengan id_kategori) -->
      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Kategori</label>
        <select id="id_kategori" name="id_kategori" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50">
          <option value="">-- Pilih Kategori --</option>
          <?php 
          // Mengambil data kategori langsung dari MySQL
          $query_kat_form = mysqli_query($conn, "SELECT * FROM tabel_kategori");
          while($kat = mysqli_fetch_assoc($query_kat_form)) {
              echo "<option value='".$kat['id_kategori']."'>".$kat['nama_kategori']."</option>";
          }
          ?>
        </select>
      </div>

      <!-- 5. Status PO -->
      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Status Ketersediaan</label>
        <select id="input_status" name="status_po" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50">
          <option value="Ready">Ready</option>
          <option value="PO">Pre-Order</option>
        </select>
      </div>

      <!-- 6. Upload Foto Produk (Penting untuk backend $_FILES) -->
      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Foto Produk</label>
        <input name="foto_produk" type="file" required class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brown-100 file:text-brown-700 hover:file:bg-brown-200" />
      </div>
    </div>

    <div class="mt-4 flex justify-end gap-3">
      <!-- Tombol tipe button biasa agar tidak men-submit form saat cancel -->
      <button type="button" onclick="toggleFormTambah()" class="px-4 py-2 rounded-lg border border-brown-300 text-brown-600 text-sm font-semibold hover:bg-brown-100 transition">Batal</button>
      <!-- Tombol submit asli untuk mengirim data ke proses_tambah.php -->
      <button type="submit" name="tambah" class="px-5 py-2 rounded-lg bg-brown-500 text-white text-sm font-bold hover:bg-brown-600 transition shadow">Simpan Produk</button>
    </div>
  </form>
</div>

    <!-- ========== TABEL PRODUK (State 1 / 5) ========== -->
<div>
  <p class="font-bold text-brown-800 text-sm tracking-widest mb-3">TABEL PRODUK</p>
  <div class="bg-white rounded-2xl border border-brown-200 shadow-sm overflow-hidden">
    
    <div class="grid grid-cols-[50px_120px_1fr_130px_120px] bg-brown-600 text-white text-[11px] font-bold tracking-widest px-4 py-3 uppercase items-center">
      <span class="text-center">No</span>
      <span>Foto</span>
      <span>Detail Kue</span>
      <span class="text-center">Harga & Stok</span>
      <span class="text-right">Aksi</span>
    </div>

<div class="divide-y divide-brown-100 bg-white">
      <?php
      // 1. Jalankan query ambil data produk & kategori
      $query_tabel = mysqli_query($conn, "SELECT tabel_produk.*, tabel_kategori.nama_kategori 
                                         FROM tabel_produk 
                                         LEFT JOIN tabel_kategori ON tabel_produk.id_kategori = tabel_kategori.id_kategori");
      
      // Cek apakah ada datanya di database
      if ($query_tabel && mysqli_num_rows($query_tabel) > 0) {
          $no = 1;
          while ($row = mysqli_fetch_assoc($query_tabel)) {
              
              // 2. Tentukan Emoji Kategori secara otomatis
              $emoji = "📦";
              $kat_nama = isset($row['nama_kategori']) ? strtolower($row['nama_kategori']) : '';
              if (strpos($kat_nama, 'pastry') !== false) { $emoji = "🥐"; }
              else if (strpos($kat_nama, 'cake') !== false) { $emoji = "🍰"; }
              else if (strpos($kat_nama, 'cookies') !== false) { $emoji = "🍪"; }
              
              // 3. Tentukan Jalur File Gambar (Arahkan ke folder assets/img/produk)
              $nama_foto = !empty($row['foto_produk']) ? $row['foto_produk'] : 'default-pastry.jpg';
              $foto_path = "../assets/product/" . $nama_foto;

              // 4. Ambil Status PO dari database secara aman
              $status_sekarang = isset($row['status_po']) ? $row['status_po'] : 'Ready';
              $badge_class = ($status_sekarang === 'Ready') 
                ? 'bg-green-50 text-green-700 border-green-200' 
                : 'bg-amber-50 text-amber-700 border-amber-200';
              ?>
              
              <div class="grid grid-cols-[50px_120px_1fr_130px_120px] px-4 py-4 items-center hover:bg-brown-50/50 transition-colors text-sm">
                
                <div class="text-center font-medium text-brown-500"><?= $no++; ?></div>
                
                <div>
                  <img src="<?= $foto_path; ?>" alt="<?= htmlspecialchars($row['nama_produk']); ?>" 
                       class="w-16 h-16 rounded-xl object-cover bg-brown-100 border border-brown-200 shadow-sm" 
                       onerror="this.onerror=null; this.src='../assets/product/default-pastry.jpg';">
                </div>
                
                <div class="flex flex-col gap-0.5">
                  <span class="font-bold text-brown-950 text-base tracking-wide"><?= htmlspecialchars($row['nama_produk']); ?></span>
                  <span class="inline-flex items-center gap-1.5 text-xs text-gray-500 font-semibold">
                    <span><?= $emoji; ?></span>
                    <span><?= !empty($row['nama_kategori']) ? htmlspecialchars($row['nama_kategori']) : 'Umum'; ?></span>
                  </span>
                </div>
                
                <div class="text-center flex flex-col gap-1">
                  <span class="font-bold text-brown-800">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                  <span class="text-xs text-gray-500 font-semibold">Stok: <b class="text-gray-700"><?= $row['stok']; ?></b></span>
                </div>
                
                <div class="flex flex-col items-end gap-2">
                  <span class="inline-block px-2 py-0.5 text-[10px] font-bold rounded-md border tracking-wide <?= $badge_class; ?>"><?= $status_sekarang; ?></span>
                  <div class="flex items-center gap-2">
                    
                    <button onclick="bukaModalEditDinamis(<?= $row['id_produk']; ?>, '<?= addslashes($row['nama_produk']); ?>', <?= $row['harga']; ?>, <?= $row['stok']; ?>, '<?= $status_sekarang; ?>', <?= $row['id_kategori']; ?>, '<?= $foto_path; ?>')" 
                            class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded-xl border border-blue-100 transition duration-150 hover:scale-110" title="Edit Produk">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    
                    <button onclick="bukaModalHapusDinamis(<?= $row['id_produk']; ?>, '<?= addslashes($row['nama_produk']); ?>', '<?= $emoji; ?>')" 
                            class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-xl border border-red-100 transition duration-150 hover:scale-110" title="Hapus Produk">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>

                  </div>
                </div>

              </div>
              <?php
          }
      } else {
          ?>
          <div class="px-6 py-12 text-center text-sm text-gray-400 font-medium bg-white rounded-b-2xl">
            Belum ada produk kue pastry di database nih... 🥣
          </div>
          <?php
      }
      ?>
    </div>

  </div>
</div>

        <!-- Table Body -->
        <div id="tableBody" class="divide-y divide-brown-100">
          <!-- Rows injected by JS -->
        </div>
      </div>
    </div>

  </main>

  <!-- ========== FOOTER ========== -->
  <footer class="bg-brown-700 text-white px-6 py-3 flex justify-between items-center text-sm mt-auto">
    <span class="font-body">PELAN – PELAN TAPI <em class="font-display italic">Pastry</em></span>
    <span class="text-brown-300 text-xs">Copyright</span>
  </footer>

  <!-- ========== MODAL EDIT (State 3) ========== -->
<div id="modalEdit" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black/50 backdrop-backdrop-filter">
  <form action="proses_edit.php" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl p-6 w-full max-w-md mx-4 animate-scaleUp">
    <h3 class="font-bold text-brown-700 text-base mb-4 flex items-center gap-2">
      <span id="editEmoji">✏️</span> Edit Data Produk
    </h3>
    
    <input type="hidden" name="id_produk" id="editId" />
    <input type="hidden" name="foto_lama" id="editFotoLama" />

    <div class="space-y-3">
      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Nama Produk</label>
        <input type="text" name="nama_produk" id="inputEditNama" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50" />
      </div>

      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Kategori</label>
        <select name="id_kategori" id="inputEditKategori" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50">
          <?php 
          $query_kat_edit = mysqli_query($conn, "SELECT * FROM tabel_kategori");
          while($kat = mysqli_fetch_assoc($query_kat_edit)) {
              echo "<option value='".$kat['id_kategori']."'>".$kat['nama_kategori']."</option>";
          }
          ?>
        </select>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <div>
          <label class="block text-xs font-semibold text-brown-600 mb-1">Harga</label>
          <input type="number" name="harga" id="inputEditHarga" min="0" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50" />
        </div>
        <div>
          <label class="block text-xs font-semibold text-brown-600 mb-1">Stok</label>
          <input type="number" name="stok" id="inputEditStok" min="0" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50" />
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Status Ketersediaan</label>
        <select name="status_po" id="inputEditStatus" required class="w-full border border-brown-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brown-400 bg-brown-50">
          <option value="Ready">Ready</option>
          <option value="PO">Pre-Order</option>
        </select>
      </div>

      <div>
        <label class="block text-xs font-semibold text-brown-600 mb-1">Ganti Foto Produk (Kosongkan jika tidak diubah)</label>
        <input type="file" name="foto_produk" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brown-100 file:text-brown-700 hover:file:bg-brown-200" />
      </div>
    </div>

    <div class="mt-5 flex justify-end gap-2">
      <button type="button" onclick="tutupModalEdit()" class="px-4 py-2 border border-brown-300 text-brown-600 rounded-lg text-sm font-semibold hover:bg-brown-100 transition">Batal</button>
      <button type="submit" name="edit_produk" class="px-4 py-2 bg-brown-500 text-white rounded-lg text-sm font-bold hover:bg-brown-600 transition shadow">Simpan Perubahan</button>
    </div>
  </form>
</div>

  <!-- ========== MODAL HAPUS (State 4) ========== -->
  <div id="modalHapus" class="hidden fixed inset-0 z-50 flex items-center justify-center modal-backdrop bg-black/30">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 p-6 animate-fadeIn text-center">
      <div class="text-4xl mb-2">⚠️</div>
      <p class="font-bold text-red-600 text-sm tracking-wide mb-1">KONFIRMASI PENGHAPUSAN</p>
      <div class="flex items-center justify-center gap-3 my-3">
        <span id="hapusEmoji" class="text-3xl"></span>
        <p class="text-brown-700 text-sm">Apakah Anda yakin ingin menghapus produk <strong id="hapusNama" class="text-brown-800"></strong>?</p>
      </div>
      <div class="flex justify-center gap-3 mt-4">
        <button onclick="tutupModalHapus()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
          Batal
        </button>

        <a id="linkHapus" href="#" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center justify-center">
          Ya, Hapus
        </a>
        </button>
      </div>
    </div>
  </div>

  <!-- ========== TOAST NOTIFIKASI ========== -->
  <div id="toast" class="hidden fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] bg-brown-700 text-white text-sm font-semibold px-5 py-3 rounded-xl shadow-lg animate-fadeIn">
    <span id="toastMsg"></span>
  </div>

<script>
let formVisible = false;

function toggleFormTambah() {
  formVisible = !formVisible;
  const form     = document.getElementById('formTambah');
  const btnIcon  = document.getElementById('btnTambahIcon');
  
  if (formVisible) {
    // 1. Munculkan Form
    form.classList.remove('hidden');
    
    // 2. Ubah Ikon + Menjadi × (Close) saat form terbuka
    if(btnIcon) {
      btnIcon.textContent = '×';
    }
  } else {
    // 1. Sembunyikan Form
    form.classList.add('hidden');
    
    // 2. Kembalikan Ikon Menjadi + saat form tertutup
    if(btnIcon) {
      btnIcon.textContent = '+';
    }
  }
}

  // Menangkap data dari tombol loop PHP untuk dimasukkan ke Modal Edit
  function bukaModalEditDinamis(id, nama, harga, stok, status, id_kategori, foto) {
    document.getElementById('editId').value           = id;
    document.getElementById('editFotoLama').value     = foto;
    document.getElementById('inputEditNama').value    = nama;
    document.getElementById('inputEditHarga').value   = harga;
    document.getElementById('inputEditStok').value    = stok;
    document.getElementById('inputEditStatus').value  = status;
    document.getElementById('inputEditKategori').value = id_kategori;

    document.getElementById('modalEdit').classList.remove('hidden');
  }

  function tutupModalEdit() {
    document.getElementById('modalEdit').classList.add('hidden');
  }

  // Menangkap data dari tombol loop PHP untuk dimasukkan ke Modal Konfirmasi Hapus
  function bukaModalHapusDinamis(id, nama, emoji) {
    document.getElementById('hapusNama').textContent  = '"' + nama + '"';
    document.getElementById('hapusEmoji').textContent = emoji;
    document.getElementById('linkHapus').href = 'hapus_produk.php?id=' + id;
    
    document.getElementById('modalHapus').classList.remove('hidden');
  }

  function tutupModalHapus() {
    document.getElementById('modalHapus').classList.add('hidden');
  }

  // Tutup modal otomatis jika area luar modal diklik
  document.getElementById('modalEdit').addEventListener('click', function(e) {
    if (e.target === this) tutupModalEdit();
  });
  document.getElementById('modalHapus').addEventListener('click', function(e) {
    if (e.target === this) tutupModalHapus();
  });
</script>

</body>
</html>