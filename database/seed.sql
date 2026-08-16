-- ============================================
-- Seed Portofolio (dijalankan hanya saat tabel kosong)
-- Password admin di-set ulang oleh migrate.php dari env
-- ============================================

INSERT INTO users (username, password_hash) VALUES
('admin', '__ADMIN_HASH__');

INSERT INTO settings (skey, value) VALUES
('site_name',  'Muhamad Ihsan Kurniawan'),
('site_title', 'Muhamad Ihsan Kurniawan — Backend & Infrastructure Engineer'),
('tagline',    'Career Switcher → Backend & Infrastructure Engineer'),
('hero_sub',   'Berpengalaman di IT Operations & Network Infrastructure untuk institusi pendidikan. Sedang membangun ekosistem infrastruktur pribadi berbasis Ubuntu Server, sambil bertransisi menjadi Backend & Infrastructure Engineer.'),
('about_text', 'Halo, saya Muhamad Ihsan Kurniawan — sedang menempuh pendidikan Informatika di SiberMu. Perjalanan saya dimulai dari dunia IT Operations & Network Infrastructure, mendukung kebutuhan teknologi institusi pendidikan.

Pengalaman itu membuka mata saya: dunia teknologi tidak hanya soal kode, tapi juga infrastruktur yang menopangnya. Karena itu saya memutuskan switch career — membangun ulang fondasi dari Linux, Networking, dan Backend Development, lalu mendokumentasikan semuanya secara terbuka lewat Project Ascend.

Prinsip saya sederhana: build, deploy, document, improve — setiap proyek dikerjakan, di-deploy, dan terus diperbaiki di homelab saya sendiri.'),
('location',   'Banyuwangi, Jawa Timur'),
('education',  'Mahasiswa Informatika @ SiberMu'),
('email',      'ihsanfreelance21@gmail.com'),
('github',     'ihsanfeelance21'),
('instagram',  'kakrantau');

INSERT INTO skills (group_name, name, is_active, sort_order) VALUES
('💻 Backend',       'PHP',              1, 1),
('💻 Backend',       'CodeIgniter 4',    1, 2),
('💻 Backend',       'Laravel',          1, 3),
('💻 Backend',       'HTML',             1, 4),
('💻 Backend',       'CSS',              1, 5),
('💻 Backend',       'JavaScript',       1, 6),
('🐧 Infrastructure', 'Ubuntu Server',   1, 1),
('🐧 Infrastructure', 'Linux',           1, 2),
('🐧 Infrastructure', 'Nginx',           1, 3),
('🐧 Infrastructure', 'Docker',          1, 4),
('🐧 Infrastructure', 'Git',             1, 5),
('🌐 Networking',    'TCP/IP',           1, 1),
('🌐 Networking',    'DNS',              1, 2),
('🌐 Networking',    'Routing',          1, 3),
('🌐 Networking',    'Network Design',   1, 4),
('☁️ DevOps & Cloud', 'GitHub Actions',  1, 1),
('☁️ DevOps & Cloud', 'Docker Compose',  1, 2),
('☁️ DevOps & Cloud', 'Cloud Computing', 1, 3),
('☁️ DevOps & Cloud', 'CI/CD',           1, 4);

INSERT INTO projects (title, slug, description, tech_stack, github_url, live_url, is_featured, is_active, sort_order) VALUES
('career-evolution', 'career-evolution',
 'Perjalanan belajar profesional — roadmap dan catatan transisi karier menuju Backend & Infrastructure Engineer.
Dokumentasi terbuka yang mengikuti setiap tahap perkembangan sebagai penunjang Project Ascend.',
 '["Markdown","Roadmap"]',
 'https://github.com/ihsanfeelance21/career-evolution', NULL, 1, 1, 1),
('homelab', 'homelab',
 'Ubuntu Server dan infrastruktur pribadi — dokumentasi pembangunan homelab dari nol.
Mencakup provisioning, hardening, dan layanan yang berjalan di atasnya.',
 '["Linux","Docker","Nginx"]',
 'https://github.com/ihsanfeelance21/homelab', NULL, 1, 1, 2),
('linux-notes', 'linux-notes',
 'Catatan belajar administrasi Linux — command, konfigurasi, dan troubleshooting.
Referensi praktis yang terus diperbarui seiring materi bertambah.',
 '["Linux","Notes"]',
 'https://github.com/ihsanfeelance21/linux-notes', NULL, 0, 1, 3),
('networking-notes', 'networking-notes',
 'Dokumentasi jaringan — TCP/IP, DNS, routing, dan network design.
Catatan kuliah dan praktik yang disusun agar mudah dipahami ulang.',
 '["Networking","TCP/IP"]',
 'https://github.com/ihsanfeelance21/networking-notes', NULL, 0, 1, 4),
('portfolio-html', 'portfolio-html',
 'Portofolio ini sendiri — awalnya statis (HTML/CSS/JS), kini memiliki sistem backend PHP murni.
Di-deploy ke homelab via CI/CD GitHub Actions dengan Nginx dan MySQL.',
 '["HTML","CSS","JS","PHP"]',
 'https://github.com/ihsanfeelance21/portfolio-html', NULL, 1, 1, 5),
('docker-lab', 'docker-lab',
 'Eksperimen Docker dan containerization — compose, image, dan networking antar-container.
Laboratorium pribadi untuk memahami ekosistem container.',
 '["Docker","DevOps"]',
 'https://github.com/ihsanfeelance21/docker-lab', NULL, 0, 1, 6),
('bash-scripts', 'bash-scripts',
 'Skrip otomasi administrasi Linux untuk mempercepat operasional sehari-hari.
Terseleksi dari masalah nyata saat mengelola homelab.',
 '["Bash","Automation"]',
 'https://github.com/ihsanfeelance21/bash-scripts', NULL, 0, 1, 7),
('dotfiles', 'dotfiles',
 'Konfigurasi Linux pribadi — shell, editor, dan environment yang ter-versioning.
Memastikan setiap setup baru bisa direproduksi dengan cepat.',
 '["Config","Linux"]',
 'https://github.com/ihsanfeelance21/dotfiles', NULL, 0, 1, 8);

INSERT INTO roadmap_items (title, is_done, sort_order) VALUES
('Hardware Preparation',           1, 1),
('Ubuntu Server Setup',            0, 2),
('Linux & Networking Foundation',  0, 3),
('Portfolio HTML',                 1, 4),
('Portfolio CodeIgniter',          0, 5),
('Docker & CI/CD',                 0, 6),
('Portfolio Laravel',              0, 7),
('Production Homelab',             0, 8),
('Cloud Deployment',               0, 9);
