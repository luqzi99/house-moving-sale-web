#!/bin/bash
set -e

echo "==> Pulling latest code..."
git pull origin main

echo "==> Rebuilding containers..."
docker compose up -d --build

echo "==> Running migrations..."
docker exec house-clearance-app php artisan migrate --force

echo "==> Clearing caches..."
docker exec house-clearance-app php artisan config:cache
docker exec house-clearance-app php artisan route:cache
docker exec house-clearance-app php artisan view:cache

echo "==> Done!"
