# Static HTML -> Backend Flow

## 1) Phan loai cau truc HTML tu `static_backup`

- `index.html`: trang chu.
- `*/index.html`: trang danh muc, list, phan trang.
- `*.html`: trang noi dung chi tiet (san pham, bai viet, trang tinh).
- `robots.txt`: quy tac crawler.

Pattern URL thuc te dang duoc dung trong HTML:
- dang duong dan day du: `/company-profile.html`
- dang index trong thu muc: `/waterproof-mattress/index.html`

Vi vay backend can ho tro ca URL goc va alias rut gon.

## 2) Chia bang du lieu

- `content_sections`
  - Nhom logic cap cao (vi du: `waterproof-mattress`, `product-news`).
  - Muc dich: gom trang theo cum de truy van va quan tri.
- `content_pages`
  - Luu noi dung trang (full HTML) + metadata SEO (`title`, `description`, `keywords`, `canonical`).
  - Mỗi ban ghi map 1 file nguon (`source_path`) de import idempotent.
- `content_page_routes`
  - Tach route ra khoi page de 1 page co nhieu URL hop le.
  - Ho tro URL goc + alias (`/x/index.html`, `/x`, `/x.html`).
- `site_files`
  - Luu file he thong (hien tai la `/robots.txt`), de backend phuc vu truc tiep.

## 3) Luong moi

1. Chay migration tao 4 bang tren.
2. Chay command `content:import-static --fresh`.
3. Command quet de quy `static_backup`, parse metadata tu tung HTML, upsert vao DB.
4. Command sinh aliases route va ghi vao `content_page_routes`.
5. Router web dung catch-all:
   - tim theo path request trong `content_page_routes`
   - lay `content_pages.html` va render
6. Endpoint `/robots.txt` doc tu `site_files`.

## 4) Loi ich

- Khong con phu thuoc hang tram file Blade static.
- Co schema ro rang de tiep tuc nang cap thanh CMS (admin edit page, cache, versioning).
- Dam bao tuong thich URL cu (quan trong cho SEO va backlink).
