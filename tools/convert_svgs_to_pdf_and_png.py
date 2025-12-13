#!/usr/bin/env python3
"""Convert SVGs in docs/images to PNG and merge PDFs into docs/slides.pdf.

Uses CairoSVG to produce PNG and PDF per SVG, then merges PDFs with PyPDF2.
"""
from pathlib import Path
import sys

def convert():
    try:
        import cairosvg
    except Exception as e:
        print('cairosvg is required:', e)
        return 2
    try:
        from PyPDF2 import PdfMerger
    except Exception as e:
        print('PyPDF2 is required:', e)
        return 3

    repo = Path(__file__).resolve().parents[1]
    images_dir = repo / 'docs' / 'images'
    svg_files = sorted(images_dir.glob('*.svg'))
    if not svg_files:
        print('No SVG files found in', images_dir)
        return 4

    pdf_paths = []
    for svg in svg_files:
        png_path = svg.with_suffix('.png')
        pdf_path = svg.with_suffix('.pdf')
        try:
            cairosvg.svg2png(url=str(svg), write_to=str(png_path))
            print('Wrote PNG', png_path)
        except Exception as e:
            print('Failed PNG for', svg, e)
        try:
            cairosvg.svg2pdf(url=str(svg), write_to=str(pdf_path))
            print('Wrote PDF', pdf_path)
            pdf_paths.append(pdf_path)
        except Exception as e:
            print('Failed PDF for', svg, e)

    # Merge PDFs
    if pdf_paths:
        merger = PdfMerger()
        for p in pdf_paths:
            merger.append(str(p))
        out_pdf = repo / 'docs' / 'slides.pdf'
        merger.write(str(out_pdf))
        merger.close()
        print('Merged PDF saved to', out_pdf)
    else:
        print('No PDFs to merge')
    return 0

if __name__ == '__main__':
    sys.exit(convert())
