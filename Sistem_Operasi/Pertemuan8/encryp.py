from Crypto.Cipher import AES
from Crypto.Util.Padding import pad, unpad
from Crypto.Random import get_random_bytes
import base64

# Fungsi untuk enkripsi data
def encrypt_data(data, key):
    # Mengonversi data menjadi bytes
    data_bytes = data.encode('utf-8')
    
    # Menggunakan AES dengan mode CBC dan padding
    cipher = AES.new(key, AES.MODE_CBC)
    
    # Menambahkan padding pada data untuk mencocokkan panjang blok AES
    ct_bytes = cipher.encrypt(pad(data_bytes, AES.block_size))
    
    # Mengembalikan hasil enkripsi sebagai base64 untuk kemudahan pengiriman atau penyimpanan
    iv = base64.b64encode(cipher.iv).decode('utf-8')
    ct = base64.b64encode(ct_bytes).decode('utf-8')
    
    return iv, ct

# Fungsi untuk dekripsi data
def decrypt_data(iv, ct, key):
    # Mengonversi data yang dienkripsi dari base64
    iv = base64.b64decode(iv)
    ct = base64.b64decode(ct)
    
    # Membuat objek cipher untuk dekripsi
    cipher = AES.new(key, AES.MODE_CBC, iv)
    
    # Mendekripsi dan menghapus padding
    pt_bytes = unpad(cipher.decrypt(ct), AES.block_size)
    
    return pt_bytes.decode('utf-8')

# Menghasilkan kunci acak 256-bit (32 bytes)
key = get_random_bytes(32)

# Contoh data yang akan dienkripsi
data = "Hello World!"

# Melakukan enkripsi
iv, encrypted_data = encrypt_data(data, key)
print(f"Encrypted data: {encrypted_data}")
print(f"IV (Initialization Vector): {iv}")

# Melakukan dekripsi
decrypted_data = decrypt_data(iv, encrypted_data, key)
print(f"Decrypted data: {decrypted_data}")
