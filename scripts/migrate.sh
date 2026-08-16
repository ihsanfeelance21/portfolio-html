#!/usr/bin/env bash
#
# Jalankan migrasi & seed di container (dipakai oleh deploy-prod.yml)
# Idempotent — aman dijalankan ulang.
#
set -euo pipefail

cd /opt/portfolio/prod
docker compose -f docker/docker-compose.prod.yml --env-file .env exec -T app php migrate.php
