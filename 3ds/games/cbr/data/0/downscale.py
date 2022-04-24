import PIL
import os
import os.path
import math
from PIL import Image

f = r'C:\\xampp\\htdocs\\3dsts\\3ds\\games\\cbr\\data\\0\\pages'
for file in os.listdir(f):
    f_img = f+"/"+file
    img = Image.open(f_img)
    fn = (os.path.basename(img.filename))
    w, h = img.size
    wn = math.floor(w/4)
    hn = math.floor(h/4)
    img = img.resize((wn, hn))
    outdir = "out"
    chk = os.path.isdir(outdir)
    if not chk:
        os.makedirs(outdir)
    img.save("out/"+fn)
