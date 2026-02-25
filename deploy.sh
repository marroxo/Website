#!/usr/bin/env bash
# ─────────────────────────────────────────────────────────────────────────────
#  TGModz deploy script
#  Usage:  bash ~/deploy.sh
#  Alias:  add the line below to ~/.bashrc or ~/.zshrc, then `source` it:
#          alias w='bash ~/deploy.sh'
# ─────────────────────────────────────────────────────────────────────────────

set -e

REPO="https://github.com/marroxo/Website.git"
DIR="$HOME/w"
PM2_NAME="tgmodz"
GH_TOKEN_FILE="$HOME/.tgmodz_ghtoken"

echo ""
echo "  ╔══════════════════════════════╗"
echo "  ║   TGModz — Deploy Script     ║"
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

# ── 1. Pull or clone into ~/w ────────────────────────────────────────────────
if [ -d "$DIR/.git" ]; then
  echo "  [1/3] Pulling latest from origin..."
  cd "$DIR"
  git remote set-url origin "$AUTH_REPO"
  git fetch origin -q
  git reset --hard origin/HEAD -q
  echo "        Done — repo is up to date."
else
  echo "  [1/3] Cloning repo into $DIR..."
  rm -rf "$DIR"
  git clone "$AUTH_REPO" "$DIR" -q
  echo "        Cloned successfully."
fi

# ── 2. Install dependencies ──────────────────────────────────────────────────
cd "$DIR"
if [ -f "package.json" ]; then
  echo "  [2/3] Installing dependencies..."
  npm install --production --silent
  echo "        node_modules ready."
else
  echo "  [2/3] No package.json found — skipping npm install."
fi

# ── 3. Restart (or start) via PM2 ───────────────────────────────────────────
echo "  [3/3] Restarting PM2 process '$PM2_NAME'..."
if pm2 describe "$PM2_NAME" > /dev/null 2>&1; then
  PORT=3001 pm2 restart "$PM2_NAME" --update-env
else
  PORT=3001 pm2 start server.js --name "$PM2_NAME"
  pm2 save
fi

echo ""
echo "  ✓  Website updated and live!"
echo "     http://45.11.229.217:3001"
echo ""
