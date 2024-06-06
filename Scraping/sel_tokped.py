import csv
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from bs4 import BeautifulSoup
import time

def scroll_to_bottom(driver):
    # Scroll ke bagian bawah halaman
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    time.sleep(5)  # Tunggu 5 detik untuk memuat konten baru

def click_next_page(driver):
    # Temukan dan klik tombol halaman berikutnya
    next_page_button = driver.find_element(By.CSS_SELECTOR, "button[aria-label='Laman berikutnya']")
    next_page_button.click()
    time.sleep(7)  # Tunggu 7 detik untuk memuat konten baru

tokped_URL = 'https://www.tokopedia.com/search?st=&q=handphone&srp_component_id=02.01.00.00&srp_page_id=&srp_page_title=&navsource='
driver = webdriver.Chrome()
driver.get(tokped_URL)

# Tunggu halaman untuk dimuat
driver.implicitly_wait(25)

data_list = []

while len(data_list) < 1100:
    # Dapatkan sumber halaman menggunakan BeautifulSoup
    soup = BeautifulSoup(driver.page_source, "html.parser")

    # Temukan semua kontainer card produk
    product_containers = soup.find_all("div", class_="css-1asz3by")

    # Loop melalui setiap kontainer produk
    for idx, container in enumerate(product_containers, start=len(data_list) + 1):
        # Ekstrak nama produk
        product_name_tag = container.find("div", class_="prd_link-product-name")
        product_name = product_name_tag.text.strip() if product_name_tag else "N/A"
        
        # Ekstrak harga produk
        product_price_tag = container.find("div", class_="prd_link-product-price")
        product_price = product_price_tag.text.strip() if product_price_tag else "N/A"
        
        # Ekstrak lokasi dan nama toko
        shop_info_tag = container.find("div", class_="css-1rn0irl")
        if shop_info_tag:
            shop_location_tag = shop_info_tag.find("span", class_="prd_link-shop-loc")
            shop_location = shop_location_tag.text.strip() if shop_location_tag else "N/A"
            
            shop_name_tag = shop_info_tag.find("span", class_="prd_link-shop-name")
            shop_name = shop_name_tag.text.strip() if shop_name_tag else "N/A"
        else:
            shop_location = "N/A"
            shop_name = "N/A"
        
        # Ekstrak rating toko
        shop_rating_tag = container.find("span", class_="prd_rating-average-text")
        shop_rating = shop_rating_tag.text.strip() if shop_rating_tag else "N/A"
        
        # Ekstrak jumlah produk yang terjual
        products_sold_tag = container.find("span", class_="prd_label-integrity")
        products_sold = products_sold_tag.text.strip() if products_sold_tag else "N/A"

        # Ekstrak URL Link produk
        product_link = container.find('a')['href'] if container.find('a') else 'N/A'
        
        # Buat kamus untuk setiap produk
        product_data = {
            "no": idx,
            "product_name": product_name,
            "product_price": product_price,
            "shop_location": shop_location,
            "shop_name": shop_name,
            "shop_rating": shop_rating,
            "products_sold": products_sold,
            "product_url": product_link
        }
        
        # Tambahkan data produk ke daftar
        data_list.append(product_data)

        # Periksa apakah jumlah entri yang diinginkan telah tercapai
        if len(data_list) == 1100:
            break

    scroll_to_bottom(driver)

    # Periksa apakah ada tombol halaman berikutnya
    try:
        next_page_button = driver.find_element(By.CSS_SELECTOR, "button[aria-label='Laman berikutnya']")
        click_next_page(driver)
    except:
        # Jika tidak ada tombol halaman berikutnya atau jumlah entri yang diinginkan telah tercapai, hentikan loop
        break

# Simpan data ke file CSV
with open("scrapingTokopedia.csv", "w", newline="", encoding='utf-8') as csv_file:
    fieldnames = ["no", "product_name", "product_price", "shop_location", "shop_name", "shop_rating", "products_sold", "product_url"]
    writer = csv.DictWriter(csv_file, fieldnames=fieldnames)
    writer.writeheader()
    for data in data_list:
        writer.writerow(data)

driver.quit()
