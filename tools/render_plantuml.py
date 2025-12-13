#!/usr/bin/env python3
import sys
import os
import re
import zlib
import base64
try:
    # Python 3
    from urllib.request import urlopen
except Exception:
    from urllib2 import urlopen

def plantuml_encode(text: bytes) -> str:
    compressed = zlib.compress(text)
    # strip zlib header and checksum (PlantUML expects raw DEFLATE)
    compressed = compressed[2:-4]
    alphabet = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_"

    def append3bytes(b1, b2, b3):
        c1 = b1 >> 2
        c2 = ((b1 & 0x3) << 4) | (b2 >> 4)
        c3 = ((b2 & 0xF) << 2) | (b3 >> 6)
        c4 = b3 & 0x3F
        return alphabet[c1] + alphabet[c2] + alphabet[c3] + alphabet[c4]

    res = []
    data = compressed
    i = 0
    while i < len(data):
        b1 = data[i]
        b2 = data[i+1] if i+1 < len(data) else 0
        b3 = data[i+2] if i+2 < len(data) else 0
        res.append(append3bytes(b1, b2, b3))
        i += 3
    return ''.join(res)

def extract_plantuml_from_md(md_text: str) -> str:
    # find triple-backtick block with plantuml or plantuml tag
    m = re.search(r"```(?:plantuml)?\n(.*?)\n```", md_text, re.S)
    if m:
        return m.group(1)
    # fallback: find @startuml..@enduml
    m2 = re.search(r"@startuml.*?@enduml", md_text, re.S)
    if m2:
        return m2.group(0)
    return ''

def render_file(path, outpath):
    if path.endswith('.puml') or path.endswith('.uml'):
        with open(path, 'rb') as f:
            text = f.read()
    else:
        with open(path, 'r', encoding='utf-8') as f:
            md = f.read()
        snippet = extract_plantuml_from_md(md)
        if not snippet:
            print('No PlantUML block found in', path)
            return 2
        text = snippet.encode('utf-8')

    encoded = plantuml_encode(text)
    server = os.environ.get('PLANTUML_SERVER', 'https://www.plantuml.com/plantuml/svg/')
    url = server + encoded
    print('Fetching', url)
    try:
        resp = urlopen(url)
        data = resp.read()
        os.makedirs(os.path.dirname(outpath), exist_ok=True)
        with open(outpath, 'wb') as out:
            out.write(data)
        print('Saved', outpath)
        return 0
    except Exception as e:
        print('Error fetching diagram:', e)
        return 3

def main():
    if len(sys.argv) < 3:
        print('Usage: render_plantuml.py <input.puml|.md> <output.svg>')
        sys.exit(1)
    inp = sys.argv[1]
    out = sys.argv[2]
    sys.exit(render_file(inp, out))

if __name__ == '__main__':
    main()
