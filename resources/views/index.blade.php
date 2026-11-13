<?php
$result = $coaches;

if (!function_exists('getBadgeClass')) {
    function getBadgeClass($status) {
        if ($status == 'Active' || $status == 'Aktif') return 'success';
        if ($status == 'Inactive' || $status == 'Tidak Aktif') return 'secondary';
        return 'primary';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Management Instruktur & Coach - Retro Athletics</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Space+Grotesk:wght@600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

  <!-- Retro Navigation Bar -->
  <nav class="navbar navbar-expand-lg retro-header sticky-top py-3">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark" href="index.php">
        <span class="fs-4 brand-font">COURT 80</span>
      </a>
      <button class="navbar-toggler border-3 border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="navbar-nav ms-auto align-items-center gap-2 mt-3 mt-lg-0">
          <li class="nav-item me-3">
    =<span class="fw-bold">Halo, {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
</li>
                        <li class="nav-item">
                            <button type="button" class="btn brutal-btn primary w-100" data-bs-toggle="modal" data-bs-target="#addCoachModal">
                                <i class="bi bi-plus-lg"></i> Tambah Pelatih
                            </button>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn brutal-btn bg-danger text-white w-100">
                                    LOGOUT
                                </button>
                            </form>
                        </li>
                    </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    <!-- Hero Banner -->
    <div class="hero-banner p-4 p-md-5 mb-5 brutal-card">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <span class="badge brutal-badge bg-dark text-white mb-2 fs-6">MODUL D — SK 03</span>
          <h1 class="display-4 fw-black mb-3">PENGELOLAAN INSTRUKTUR & COACH MITRA</h1>
          <p class="fs-5 fw-medium mb-4 text-white-50" style="color: #FFF !important;">
            Sistem pendataan resmi lisensi instruktur, keahlian cabang olahraga (<span class="text-warning fw-bold">Futsal, Badminton, Basket, Padel</span>), serta jadwal pelatihan terintegrasi venue.
          </p>
          <div class="d-flex flex-wrap gap-2">
            <a href="#coach-section" class="btn brutal-btn-secondary">
              <i class="bi bi-search me-1"></i> Pencarian Coach
            </a>
            <a href="tambah_pelatih.php" class="btn btn-light brutal-btn-primary border-3 border-dark text-dark" style="background:#FFF !important; color:#111827 !important;">
              <i class="bi bi-patch-check-fill me-1"></i> Registrasi Lisensi Baru
            </a>
          </div>
        </div>
        <div class="col-lg-4 d-none d-lg-block text-center">
          <i class="bi bi-person-workspace display-1 text-dark" style="font-size: 9rem; opacity: 0.9;"></i>
        </div>
      </div>
    </div>

    <!-- Main Content Section -->
    <div id="coach-section">
      <!-- Filter Bar Form -->
      <form method="GET" action="index.php" class="brutal-card p-3 mb-4">
        <div class="row g-3 align-items-center">
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-text bg-dark text-white border-3 border-dark fw-bold">
                <i class="bi bi-search"></i>
              </span>
              <input type="text" name="search" class="form-control brutal-input" placeholder="Cari Nama / No. Lisensi..." value="<?= htmlspecialchars($search); ?>">
            </div>
          </div>
          <div class="col-md-3">
            <select name="sport" class="form-select brutal-select" onchange="this.form.submit()">
              <option value="">Semua Cabang Olahraga</option>
              <option value="Futsal" <?= $sport == 'Futsal' ? 'selected' : ''; ?>>Futsal</option>
              <option value="Badminton" <?= $sport == 'Badminton' ? 'selected' : ''; ?>>Badminton</option>
              <option value="Basket" <?= $sport == 'Basket' ? 'selected' : ''; ?>>Basket</option>
              <option value="Padel" <?= $sport == 'Padel' ? 'selected' : ''; ?>>Padel</option>
            </select>
          </div>
          <div class="col-md-3">
            <select name="status" class="form-select brutal-select" onchange="this.form.submit()">
              <option value="">Semua Status Mitra</option>
              <option value="Aktif" <?= $status == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
              <option value="Non-Aktif" <?= $status == 'Non-Aktif' ? 'selected' : ''; ?>>Non-Aktif</option>
            </select>
          </div>
          <div class="col-md-2 d-flex justify-content-end gap-2">
            <button type="submit" class="btn brutal-btn-primary py-2 px-3"><i class="bi bi-filter"></i> Filter</button>
            <a href="index.php" class="btn brutal-btn-secondary py-2 px-3" title="Reset"><i class="bi bi-arrow-counterclockwise"></i></a>
          </div>
        </div>
      </form>

      <!-- Stats Counters -->
      <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
          <div class="brutal-card p-3 text-center" style="background-color: #FFF;">
            <div class="fs-6 fw-bold text-muted uppercase">Total Coach</div>
            <div class="fs-2 fw-black brand-font"><?= $totalCoach; ?></div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="brutal-card p-3 text-center" style="background-color: var(--mustard-yellow);">
            <div class="fs-6 fw-bold text-dark uppercase">Lisensi Aktif</div>
            <div class="fs-2 fw-black brand-font"><?= $activeCoach; ?></div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="brutal-card p-3 text-center" style="background-color: var(--retro-orange); color:#FFF;">
            <div class="fs-6 fw-bold uppercase">Cabang Olahraga</div>
            <div class="fs-2 fw-black brand-font">4 Cabang</div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="brutal-card p-3 text-center" style="background-color: var(--classic-navy); color:#FFF;">
            <div class="fs-6 fw-bold uppercase">Sewa Alat Terkait</div>
            <div class="fs-2 fw-black brand-font">Modul B</div>
          </div>
        </div>
      </div>

      <!-- GRID VIEW -->
      <div class="row g-4">
<?php
$coachesArray = [];
if (count($coaches) > 0):
    foreach ($coaches as $coach):
        $c = is_array($coach) ? $coach : $coach->toArray();
        $coachesArray[] = $c;
        $defaultAvatar = "https://ui-avatars.com/api/?name=" . urlencode($c['name']) . "&background=111827&color=fff&bold=true";
        $avatarUrl = !empty($c['avatar']) ? $c['avatar'] : $defaultAvatar;
        $badgeClass = getBadgeClass($c['sport'] ?? ($c['primary_sport'] ?? ''));
?>
<div class="col-md-6 col-lg-4">
    <div class="brutal-card p-3 h-100 d-flex flex-column justify-content-between bg-white">
        @php
            $sc = is_array($coach) ? $coach : $coach->toArray();
            $sDefaultAvatar = "https://ui-avatars.com/api/?name=" . urlencode($sc['name']) . "&background=111827&color=fff&bold=true";
            $sAvatarUrl = !empty($sc['avatar']) ? $sc['avatar'] : $sDefaultAvatar;
            $sBadgeClass = getBadgeClass($sc['sport'] ?? ($sc['primary_sport'] ?? ''));
        @endphp

        <div>
            <!-- Header Card: Sport & Status -->
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="badge brutal-badge {{ $sBadgeClass }}">{{ htmlspecialchars($sc['sport']) }}</span>
                <span class="d-flex align-items-center gap-1 small fw-bold">
                    <span class="coach-status {{ $sc['status'] == 'Aktif' ? 'status-active' : 'status-inactive' }}"></span>
                    {{ htmlspecialchars($sc['status']) }}
                </span>
            </div>

            <!-- Profil Coach -->
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="{{ $sAvatarUrl }}" class="coach-avatar rounded-circle" alt="{{ htmlspecialchars($sc['name']) }}" onerror="this.src='{{ $sDefaultAvatar }}'">
                <div>
                    <h5 class="fw-bold mb-1 brand-font">{{ htmlspecialchars($sc['name']) }}</h5>
                    <div class="badge brutal badge-brand badge-license mb-1">
                        <i class="bi bi-card-heading me-1"></i>{{ htmlspecialchars($sc['license']) }}
                    </div>
                    <div class="small fw-semibold text-muted">
                        <i class="bi bi-clock-history me-1"></i>Pengalaman {{ $sc['exp'] }};
                    </div>
                </div>
            </div>

            <!-- Bio singkat -->
            <p class="small text-dark fw-normal mb-3 line-clamp-2" style="-webkit-box-orient: vertical; overflow: hidden;">
                {{ htmlspecialchars($sc['bio'] ?? 'Instruktur mitra berpengalaman untuk mendampingi latihan private maupun tim.') }}
            </p>
        </div>

        <div>
            <!-- Tarif Sesi -->
            <div class="p-2 border border-2 border-dark mb-3 bg-light d-flex justify-content-between align-items-center">
                <span class="small fw-bold uppercase">Tarif Sesi:</span>
                <span class="fw-black text-danger brand-font fs-6">Rp {{ number_format($sc['rate'], 0, ',', '.') }}</span>
            </div>

            <!-- Tombol Aksi (Detail, Edit, Hapus) -->
            <div class="d-flex gap-2">
                <!-- Tombol Detail -->
                <button type="button" class="btn brutal btn-secondary py-1 fs-7 px-2" onclick="openDetailModal({{ $coach->id }})" title="Detail">
                    <i class="bi bi-eye-fill"></i>
                </button>

                <!-- Tombol Edit -->
                <button type="button" class="btn brutal btn-primary flex-grow-1 py-1 fs-7 text-center text-dark btn-edit-coach" data-bs-toggle="modal" data-bs-target="#editCoachModal" data-id="{{ $coach->id }}" data-name="{{ $coach->name }}" data-sport="{{ $coach->sport }}" data-license="{{ $coach->license }}" data-status="{{ $coach->status }}">
                    <i class="bi bi-pencil-fill me-1"></i> Edit
                </button>

                {{-- Tombol Hapus Khusus Admin --}}
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <form action="{{ route('coaches.destroy', $coach->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin mau hapus coach ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn brutal-btn btn-sm py-1 px-2 text-white bg-dark">
                            <i class="bi bi-trash-fill text-danger"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
        <?php 
            endforeach;
        else: 
        ?>
            <div class="col-12 text-center py-5">
              <div class="brutal-card p-5 bg-white">
                <i class="bi bi-emoji-frown display-3 text-muted"></i>
                <h4 class="mt-3 fw-bold">Data Instruktur/Coach Tidak Ditemukan</h4>
                <p class="text-muted">Coba ubah kata kunci pencarian atau reset filter.</p>
              </div>
            </div>
        <?php endif; ?>
      </div>

    </div>

  </div>

  <!-- MODAL DETAIL COACH -->
  <div class="modal fade" id="detailCoachModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content brutal-modal">
        <div class="modal-header brutal-modal-header" style="background-color: var(--classic-navy);">
          <h5 class="modal-title fw-bold text-white"><i class="bi bi-person-lines-fill me-2"></i>PROFIL INSTRUKTUR MITRA</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 text-center" id="detailModalBody">
        </div>
        <div class="modal-footer brutal-modal-footer justify-content-between">
          <button type="button" class="btn brutal-btn-primary py-1 px-3" data-bs-dismiss="modal">Tutup</button>
          <span class="small fw-bold text-muted">Aplikasi Venue SK 03</span>
        </div>
      </div>
    </div>
  </div>
<!-- MODAL TAMBAH COACH -->
<div class="modal fade" id="addCoachModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content brutal-modal">
            <div class="modal-header brutal-modal-header" style="background-color: var(--retro-orange, #FF6B35);">
                <h5 class="modal-title fw-bold text-white"><i class="bi bi-person-plus-fill me-2"></i>TAMBAH PELATIH BARU</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('coaches.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Coach Budi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cabang Olahraga</label>
                        <input type="text" name="sport" class="form-control" placeholder="Contoh: Padel / Sepakbola" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Lisensi</label>
                        <input type="text" name="license" class="form-control" placeholder="Contoh: LIC-12345">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pengalaman (Tahun)</label>
                            <input type="number" name="exp" class="form-control" placeholder="Contoh: 3" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tarif Sesi (Rp)</label>
                            <input type="number" name="rate" class="form-control" placeholder="Contoh: 50000" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">URL Foto Avatar (Optional)</label>
                        <input type="url" name="avatar" class="form-control" placeholder="https://images.unsplash.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer brutal-modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary py-1 px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn brutal-btn-primary py-1 px-3">Simpan Coach</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT COACH -->
<div class="modal fade" id="editCoachModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content brutal-modal">
            <div class="modal-header brutal-modal-header" style="background-color: var(--classic-navy, #004E98);">
                <h5 class="modal-title fw-bold text-white"><i class="bi bi-pencil-square me-2"></i>EDIT DATA PELATIH</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCoachForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cabang Olahraga</label>
                        <input type="text" name="sport" id="edit_sport" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Lisensi</label>
                        <input type="text" name="license" id="edit_license" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pengalaman (Tahun)</label>
                            <input type="number" name="exp" id="edit_exp" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tarif Sesi (Rp)</label>
                            <input type="number" name="rate" id="edit_rate" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">URL Foto Avatar (Optional)</label>
                        <input type="url" name="avatar" id="edit_avatar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" id="edit_status" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer brutal-modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary py-1 px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn brutal-btn-primary py-1 px-3">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT AUTO-FILL EDIT MODAL -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll('.btn-edit-coach');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const sport = this.getAttribute('data-sport');
                const license = this.getAttribute('data-license');
                const exp = this.getAttribute('data-exp');
                const rate = this.getAttribute('data-rate');
                const avatar = this.getAttribute('data-avatar');
                const status = this.getAttribute('data-status');

                // Set Action Form Update sesuai ID Coach
                document.getElementById('editCoachForm').action = '/coaches/' + id;

                // Isi input dengan data lama
                document.getElementById('edit_name').value = name || '';
                document.getElementById('edit_sport').value = sport || '';
                document.getElementById('edit_license').value = license || '';
                document.getElementById('edit_exp').value = exp || 0;
                document.getElementById('edit_rate').value = rate || 0;
                document.getElementById('edit_avatar').value = avatar || '';
                document.getElementById('edit_status').value = status || 'Aktif';
            });
        });
    });
</script>

  <!-- FOOTER -->
  <footer class="mt-5 py-4 border-top border-4 border-dark bg-white">
    <div class="container">
      <div class="brutal-card p-3" style="background-color: var(--mustard-yellow);">
        <div class="row align-items-center g-2">
          <div class="col-md-6">
            <span class="badge brutal-badge bg-dark text-white mb-1">IDENTITAS MAHASISWA</span>
            <h5 class="fw-black mb-0 brand-font">Salma Rahma Fauziah</h5>
            <p class="mb-0 fw-bold text-dark small">NIM: 102022530020 | Kelas: SI-49-07</p>
          </div>
          <div class="col-md-6 text-md-end">
            <div class="fw-bold text-dark">Nama Kelompok: <span class="badge brutal-badge bg-white text-dark">Kelompok 3</span></div>
            <div class="fw-bold text-dark mt-1">Modul / Fitur: <span class="badge brutal-badge badge-license">Modul D - Instruktur & Coach</span></div>
          </div>
        </div>
      </div>
      <div class="text-center mt-3 fs-7 fw-bold text-muted">
        &copy; 2026 Tugas Web Development - Telkom University
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const coachesData = <?= json_encode($coachesArray); ?>;
    const detailCoachModal = new bootstrap.Modal(document.getElementById('detailCoachModal'));

    function formatRupiah(number) {
      return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
    }

    function openDetailModal(id) {
      const c = coachesData.find(item => item.id == id);
      if (c) {
        const defaultAvatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(c.name)}&background=111827&color=FFF&bold=true`;
        const avatarUrl = c.avatar ? c.avatar : defaultAvatar;

        const detailHtml = `
          <img src="${avatarUrl}" class="coach-avatar rounded-circle mb-3 mx-auto" style="width:120px; height:120px;" alt="${c.name}">
          <h4 class="fw-bold brand-font mb-1">${c.name}</h4>
          <div class="mb-3">
            <span class="badge brutal-badge bg-dark text-white me-1">${c.sport}</span>
            <span class="badge brutal-badge badge-license"><i class="bi bi-card-heading me-1"></i>${c.license}</span>
          </div>
          
          <div class="p-3 border border-3 border-dark bg-white mb-3 text-start">
            <div class="row g-2">
              <div class="col-6 fw-bold">Pengalaman:</div>
              <div class="col-6 text-end">${c.exp} Tahun Kepelatihan</div>
              <div class="col-6 fw-bold">Tarif Melatih:</div>
              <div class="col-6 text-end text-danger fw-bold">${formatRupiah(c.rate)} / Sesi</div>
              <div class="col-6 fw-bold">Status Mitra:</div>
              <div class="col-6 text-end"><span class="badge ${c.status === 'Aktif' ? 'bg-success' : 'bg-danger'}">${c.status}</span></div>
            </div>
          </div>

          <div class="text-start">
            <h6 class="fw-bold uppercase mb-1"><i class="bi bi-info-circle me-1"></i>Bio & Catatan Instruktur:</h6>
            <p class="small text-muted p-2 border border-2 border-dark bg-light mb-0">
              ${c.bio || 'Tidak ada catatan khusus.'}
            </p>
          </div>
        `;
        document.getElementById('detailModalBody').innerHTML = detailHtml;
        detailCoachModal.show();
      }
    }
  </script>
</body>
</html>