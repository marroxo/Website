#!/usr/bin/env bash
# ─────────────────────────────────────────────────────────────────────────────
#  TCD deploy script
#  Usage:  bash ~/deploy.sh
# ─────────────────────────────────────────────────────────────────────────────

set -e

REPO="https://github.com/marroxo/Website.git"
BRANCH="main"
DIR="$HOME/w"
PM2_NAME="tcd"
PORT="${PORT:-3100}"
GH_TOKEN_FILE="$HOME/.tgmodz_ghtoken"

echo ""
echo "  ╔══════════════════════════════╗"
echo "  ║     TCD — Deploy Script      ║"
echo "  ╚══════════════════════════════╝"
echo ""

# ── GitHub token ─────────────────────────────────────────────────────────────
if [ ! -f "$GH_TOKEN_FILE" ]; then
  echo "  [SETUP] Enter your GitHub personal access token (repo read access):"
  read -rsp "  GitHub token: " gh_tok; echo
  printf '%s' "$gh_tok" > "$GH_TOKEN_FILE"
  chmod 600 "$GH_TOKEN_FILE"
  echo "  Token saved. Run the script again to deploy."
  echo ""
  exit 0
fi

GH_TOKEN=$(cat "$GH_TOKEN_FILE")
AUTH_REPO="https://${GH_TOKEN}@github.com/marroxo/Website.git"

# ── 1. Pull or clone ──────────────────────────────────────────────────────────
if [ -d "$DIR/.git" ]; then
  echo "  [1/3] Pulling latest from origin ($BRANCH)..."
  cd "$DIR"
  git remote set-url origin "$AUTH_REPO"
  git fetch origin -q
  git checkout -B "$BRANCH" "origin/$BRANCH" -q
  git reset --hard "origin/$BRANCH" -q
  echo "        Done — repo is up to date."
else
  echo "  [1/3] Cloning repo into $DIR (branch: $BRANCH)..."
  rm -rf "$DIR"
  git clone -b "$BRANCH" "$AUTH_REPO" "$DIR" -q
  echo "        Cloned successfully."
fi

cd "$DIR"

# ── 2. Ensure PHP is available ────────────────────────────────────────────────
echo "  [2/3] Checking PHP..."
if ! command -v php >/dev/null 2>&1; then
  echo "        PHP not found — installing..."
  if command -v apt-get >/dev/null 2>&1; then
    sudo apt-get update -qq
    sudo apt-get install -y -qq php-cli
  elif command -v yum >/dev/null 2>&1; then
    sudo yum install -y -q php-cli
  else
    echo "        ERROR: Cannot install PHP automatically. Please install php-cli manually."
    exit 1
  fi
fi
PHP_VER=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
echo "        PHP $PHP_VER ready."

# ── 3. Start / restart via PM2 ────────────────────────────────────────────────
echo "  [3/3] Restarting PM2 process '$PM2_NAME'..."

if pm2 describe "$PM2_NAME" > /dev/null 2>&1; then
  pm2 delete "$PM2_NAME" --silent 2>/dev/null || true
fi

PORT=$PORT pm2 start php \
  --name "$PM2_NAME" \
  --interpreter none \
  -- -S "0.0.0.0:$PORT" -t .

pm2 save --force

echo ""
echo "  ✓  TCD is live!"
echo "     http://45.11.229.217:$PORT"
echo ""
