#!/usr/bin/env bash
set -euo pipefail

THEME_SLUG="bloom"
OUT_DIR="dist"
STAGING_DIR="${OUT_DIR}/${THEME_SLUG}"
ZIP_PATH="${OUT_DIR}/${THEME_SLUG}.zip"

rm -rf "${STAGING_DIR}" "${ZIP_PATH}"
mkdir -p "${STAGING_DIR}"

# Copy all theme files except development artifacts.
rsync -a ./ "${STAGING_DIR}/" \
  --exclude='.git' \
  --exclude='dist' \
  --exclude='scripts' \
  --exclude='*.zip'

if [[ ! -f "${STAGING_DIR}/style.css" ]]; then
  echo "Error: style.css was not found in the packaged theme root (${STAGING_DIR})." >&2
  exit 1
fi

if ! grep -q '^Theme Name:' "${STAGING_DIR}/style.css"; then
  echo "Error: style.css exists but does not contain a valid WordPress theme header (Theme Name)." >&2
  exit 1
fi

(
  cd "${OUT_DIR}"
  zip -r "${THEME_SLUG}.zip" "${THEME_SLUG}" >/dev/null
)

echo "Created ${ZIP_PATH}"
echo "Upload this zip file in WordPress: Appearance > Themes > Add New > Upload Theme"
