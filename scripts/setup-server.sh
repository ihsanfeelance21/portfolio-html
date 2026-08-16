#!/usr/bin/env bash
#
# Setup server untuk portofolio (mirror pola webrent)
#   1. Install & register self-hosted runner KHUSUS portofolio (label: portfolio)
#   2. Siapkan /opt/portfolio/prod + .env default
#
# Cara pakai (dijalankan DI SERVER, pakai akun dengan sudo):
#   sudo bash scripts/setup-server.sh --token <RUNNER_TOKEN>
#
# RUNNER_TOKEN didapat dari:
#   GitHub repo -> Settings -> Actions -> Runners -> New self-hosted runner
#
set -euo pipefail

RUNNER_TOKEN=""
RUNNER_NAME="portfolio-runner"
RUNNER_LABELS="portfolio"
RUNNER_DIR="/opt/actions-runner-portfolio"
APP_DIR="/opt/portfolio/prod"
PORT="${PORT:-8080}"
ARCH="x64"

while [[ $# -gt 0 ]]; do
  case "$1" in
    --token) RUNNER_TOKEN="$2"; shift 2 ;;
    *) echo "!! argumen tidak dikenal: $1"; exit 1 ;;
  esac
done

[ -n "$RUNNER_TOKEN" ] || {
  echo "!! --token wajib diisi. Token: Settings -> Actions -> Runners -> New self-hosted runner"
  exit 1
}

REPO_URL="https://github.com/ihsanfeelance21/portfolio-html"

echo "== Prasyarat =="
for bin in docker curl tar; do
  command -v "$bin" >/dev/null 2>&1 || { echo "!! $bin belum terinstall"; exit 1; }
done
docker info >/dev/null 2>&1 || { echo "!! docker daemon tidak jalan (coba: sudo systemctl start docker)"; exit 1; }
echo "== Prasyarat OK =="

# ---------- 1. Self-hosted runner ----------
if [ -d "$RUNNER_DIR" ]; then
  echo "!! Runner sudah ada di $RUNNER_DIR — skip install, cek service:"
  cd "$RUNNER_DIR"
  sudo -u root ./svc.sh status 2>/dev/null || true
else
  echo "== Mendeteksi versi runner terbaru =="
  LATEST_URL=$(curl -fsSL https://api.github.com/repos/actions/runner/releases/latest \
    | grep -o '"browser_download_url": *"[^"]*'"${ARCH}"'[^"]*linux[^"]*tar.gz"' \
    | head -1 | sed 's/.*"browser_download_url": *"//; s/"$//')
  [ -n "$LATEST_URL" ] || { echo "!! gagal mengambil URL runner"; exit 1; }
  echo "   URL: $LATEST_URL"

  mkdir -p "$RUNNER_DIR"
  cd "$RUNNER_DIR"
  curl -fsSL -o runner.tar.gz "$LATEST_URL"
  tar xzf runner.tar.gz
  rm -f runner.tar.gz

  echo "== Config runner (label: $RUNNER_LABELS) =="
  ./config.sh --url "$REPO_URL" --token "$RUNNER_TOKEN" \
    --name "$RUNNER_NAME" --labels "$RUNNER_LABELS" --unattended --replace

  echo "== Install & start sebagai service =="
  sudo ./svc.sh install
  sudo ./svc.sh start
  sudo ./svc.sh status || true
  echo "== Runner siap =="
fi

# ---------- 2. Direktori deploy ----------
echo "== Siapkan $APP_DIR =="
mkdir -p "$APP_DIR"
if [ ! -f "$APP_DIR/.env" ]; then
  printf 'PORT=%s\n' "$PORT" > "$APP_DIR/.env"
  echo "   .env dibuat (PORT=$PORT)"
else
  echo "   .env sudah ada, dibiarkan"
fi

echo ""
echo "== Selesai. Selanjutnya: =="
echo "  1. Push ke branch main di repo portfolio-html"
echo "     -> GitHub Actions (label [self-hosted, portfolio]) akan deploy otomatis"
echo "  2. Akses website: http://IP_SERVER:${PORT}"
echo "  3. Pastikan port ${PORT} terbuka di firewall:"
echo "     sudo ufw allow ${PORT}/tcp"
