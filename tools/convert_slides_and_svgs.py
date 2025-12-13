#!/usr/bin/env python3
"""Convert docs/slides.html to a simple PDF and export SVGs to PNG.

This script does two things:
- Convert each generated SVG in `docs/images/` to a PNG using CairoSVG.
- Create a simple PDF `docs/slides.pdf` by placing the SVG images and slide headings as pages using ReportLab.

This is a pragmatic fallback when headless Chromium or wkhtmltopdf isn't available.
"""
from pathlib import Path
import sys
from reportlab.lib.pagesizes import A4, landscape
from reportlab.pdfgen import canvas
from reportlab.lib.utils import ImageReader

def svg_to_png(svg_path, png_path):
    try:
        import cairosvg
        cairosvg.svg2png(url=str(svg_path), write_to=str(png_path))
        print(f'Converted {svg_path} -> {png_path}')
        return True
    except Exception as e:
        print('SVG->PNG conversion failed for', svg_path, e)
        return False

def make_pdf_from_svgs(svg_files, out_pdf):
    # Create a simple PDF: one SVG per page (scaled to fit)
    c = canvas.Canvas(str(out_pdf), pagesize=landscape(A4))
    w, h = landscape(A4)
    for svg in svg_files:
        try:
            # Try direct PNG conversion and embed PNG (ReportLab easier with raster images)
            png = svg.with_suffix('.png')
            if not png.exists():
                svg_to_png(svg, png)
            img = ImageReader(str(png))
            iw, ih = img.getSize()
            # scale to fit within page margins
            scale = min((w-72)/iw, (h-72)/ih)
            iw2 = iw * scale
            ih2 = ih * scale
            x = (w - iw2) / 2
            y = (h - ih2) / 2
            c.drawImage(img, x, y, width=iw2, height=ih2)
            c.showPage()
        except Exception as e:
            print('Failed to add', svg, e)
    c.save()
    print('Saved PDF', out_pdf)

def main():
    repo = Path(__file__).resolve().parents[1]
    images_dir = repo / 'docs' / 'images'
    svg_files = sorted(images_dir.glob('*.svg'))
    if not svg_files:
        print('No SVG files found in', images_dir)
        sys.exit(2)

    # Convert SVGs to PNGs
    for s in svg_files:
        p = s.with_suffix('.png')
        svg_to_png(s, p)

    # Create PDF from SVGs
    out_pdf = repo / 'docs' / 'slides.pdf'
    make_pdf_from_svgs(svg_files, out_pdf)

if __name__ == '__main__':
    main()
