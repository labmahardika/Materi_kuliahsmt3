from kivy.app import App
# Mengimpor kelas App dari modul kivy.app. Kelas App adalah dasar untuk semua aplikasi Kivy.
from kivy.uix.boxlayout import BoxLayout
# Mengimpor kelas BoxLayout dari modul kivy.uix.boxlayout
class HelloWorld(BoxLayout):
 pass
class HelloWorldApp(App):
 def build(self):
#  Metode build adalah metode khusus dalam App yang dipanggil saat aplikasi dijalankan.
     return HelloWorld()

if __name__ == '__main__':
#Kode hanya akan dijalankan jika file ini dieksekusi secara langsung, bukan diimpor sebagai modul.
 HelloWorldApp().run()
 