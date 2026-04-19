# Bloom WordPress Theme

If WordPress reports `The theme is missing the style.css stylesheet`, it almost always means the zip file structure is wrong.

## Correct zip structure

The uploaded zip must contain a single top-level folder with `style.css` directly inside it:

- `bloom.zip`
  - `bloom/style.css`
  - `bloom/functions.php`
  - `bloom/index.php`
  - etc.

## Build a valid upload zip

From the project root run:

```bash
./scripts/package-theme.sh
```

This creates:

- `dist/bloom.zip`

Upload `dist/bloom.zip` in WordPress.
