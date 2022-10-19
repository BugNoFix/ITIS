import mysql.connector, re, requests, json
import random
import cv2
import numpy, os

from rembg.bg import remove
import numpy as np
import io
from PIL import Image

from PIL import ImageFile
ImageFile.LOAD_TRUNCATED_IMAGES = True

def RemoveBackground(Dir):
	output_path = input_path = Dir

	f = np.fromfile(input_path)
	result = remove(f)
	img = Image.open(io.BytesIO(result)).convert("RGBA")
	img.save(output_path)

def Crop(Dir):
	# Opens a image in RGB mode
	im = Image.open(Dir)
	  
	# Size of the image in pixels (size of orginal image)
	# (This is not mandatory)
	width, height = im.size
	  
	# Setting the points for cropped image
	left = 104
	top = 474
	right = 1526
	bottom = 1526
	  
	# Cropped image of above dimension
	# (It will not change orginal image)
	im1 = im.crop((left, top, left + right, top + bottom))
	im1.save(Dir)
  
def CheckUrlImg(url):
	num = re.search(r'static\.nike\.com\/a\/images\/t_PDP_(.*)_v1', str(url), re.IGNORECASE).group(1)
	if int(num) != 1728:
		return url.replace(num, "1728")
	return url

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="elaborato"
)
mycursor = mydb.cursor()

# Get data
file1 = open('URLS.txt', 'r')
URLS = file1.readlines()
for URL in URLS:
	URLV = URL.split("|")[0]
	URLM =  URL.split("|")[1]
	page = requests.get(URLV).text
	name = re.search(r'product-title">(.*)<\/h1>', str(page), re.IGNORECASE).group(1)
	price = re.search(r'data-test="product-price">(.*)\s€', str(page), re.IGNORECASE).group(1).split(",")[0]
	giacenza = "Via salemi 90"
	percorsoImmagine = "img/Scarpe/" + name.replace(" ", "-") + ".png"
	sconti = [0, 20, 30, 50, 75]
	sconto = sconti[random.randint(0,4)]
	recensione = random.randint(3,5)

	URLM = CheckUrlImg(URLM)
	# Download image
	Img = requests.get(URLM).content
	try:
		with open(percorsoImmagine, 'wb') as handler:
		    handler.write(Img)
		# Remove background
		RemoveBackground(percorsoImmagine )
		Crop(percorsoImmagine)
		print("\n======================================")
		print("Nome: " + name + "\nPrice: " + price + "\nGiacenza: " + "\nPercorsoImmagine: " + percorsoImmagine + "\nSconto: " + str(sconto) + "\nRecensione: "+ str(recensione))
		print("=======================================")
		sql = "INSERT INTO prodotto (Id, Nome, Prezzo, Giacenza, Sconto, PercorsoImmagine, Recensione, IdCategoria) VALUES (\"\", \"{0}\", {1}, \"{2}\", {3}, \"{4}\", \"{5}\", 5)".format(name, price, giacenza, sconto, percorsoImmagine, recensione)
		mycursor.execute(sql)
		mydb.commit()
	except:
		print("ERROR: " + URLV)