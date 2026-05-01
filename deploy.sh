#!/bin/bash
# Run this after every git pull on the VPS:  bash deploy.sh
set -euo pipefail

# ── Colours ────────────────────────────────────────────────────────────────────
RED='\033[0;31m'; GREEN='\033[0;32m'; YELLOW='\033[1;33m'
CYAN='\033[0;36m'; BOLD='\033[1m'; RESET='\033[0m'

step()  { echo -e "\n${CYAN}${BOLD}==> $1${RESET}"; }
ok()    { echo -e "${GREEN}✔  $1${RESET}"; }
warn()  { echo -e "${YELLOW}⚠  $1${RESET}"; }
die()   { echo -e "${RED}✘  $1${RESET}"; exit 1; }

APP_CONTAINER="house-clearance-app"

echo -e "\n${BOLD}━━━  Moving Out Sale — Deploy  ━━━${RESET}"
echo -e "$(date '+%Y-%m-%d %H:%M:%S') · $(git rev-parse --short HEAD 2>/dev/null || echo 'unknown')"

# ── 1. Git pull ─────────────────────────────────────────────────────────────
step "Pulling latest code"
git pull origin master && ok "Code up to date" || die "git pull failed"

# ── 2. Rebuild image ─────────────────────────────────────────────────────────
# Code is COPY'd into the image, so we must rebuild on every deploy.
step "Rebuilding Docker image & restarting containers"
docker compose up -d --build && ok "Containers running" || die "docker compose failed"

# ── 3. Wait for app container to be healthy ──────────────────────────────────
step "Waiting for app container to be ready"
RETRIES=15
until docker exec "$APP_CONTAINER" php -r "echo 'ok';" &>/dev/null; do
    RETRIES=$((RETRIES - 1))
    if [ "$RETRIES" -eq 0 ]; then
        die "App container did not start in time. Check: docker logs $APP_CONTAINER"
    fi
    echo "  waiting... ($RETRIES retries left)"
    sleep 3
done
ok "Container is ready"

# ── 4. Run migrations ────────────────────────────────────────────────────────
step "Running database migrations"
docker exec "$APP_CONTAINER" php artisan migrate --force && ok "Migrations done" || die "Migrations failed"

# ── 5. Rebuild caches ────────────────────────────────────────────────────────
step "Rebuilding caches"
docker exec "$APP_CONTAINER" php artisan config:cache && ok "Config cached"
docker exec "$APP_CONTAINER" php artisan route:cache  && ok "Routes cached"
docker exec "$APP_CONTAINER" php artisan view:cache   && ok "Views cached"

# ── 6. Summary ───────────────────────────────────────────────────────────────
echo ""
echo -e "${GREEN}${BOLD}━━━  Deploy complete!  ━━━${RESET}"
echo ""
docker compose ps
echo ""
