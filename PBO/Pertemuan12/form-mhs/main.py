from kivy.app import App
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.popup import Popup
from kivy.uix.label import Label
from kivy.uix.button import Button
from kivy.core.window import Window
from kivy.utils import get_color_from_hex
#Import Library Mysql-Connector
import mysql.connector

class InputForm(BoxLayout):
    def __init__(self, **kwargs):
        super().__init__(**kwargs)
        self.mydb = mysql.connector.connect(
            host    = "localhost",
            user    = "root",
            password= "",
            database="sikampus"
    )
        self.mycursor = self.mydb.cursor()
    def show_data(self):
        # Ambil data dari text input
        nama = self.ids.nama_input.text
        nim = self.ids.nim_input.text
        jurusan = self.ids.jurusan_input.text
        #Validasi Inputan tidak kosong
        if not nama or not nim or not jurusan:
            popup = Popup(title="Error", content=Label(text="Semua field harus diisi."), size_hint=(0.8, 0.4), auto_dismiss=True)
            popup.open()
            return
        
        # Format data untuk ditampilkan
        data = f"Nama: {nama}\nNIM: {nim}\nJurusan: {jurusan}"
        # Buat PopUp
        popup = Popup(
            title="Data Mahasiswa",
            content=Label(text=data), 
            size_hint=(0.8, 0.4),
            auto_dismiss=True,
        )

        # Tambahkan tombol untuk menutup pop-up
        close_btn = Button(text="Tutup", size_hint_y=None, height=40)
        close_btn.bind(on_release=popup.dismiss)
        popup.content.add_widget(close_btn)

        
        # Tampilkan pop-up
        popup.open()
        # Membuat Koneksi Ke Database

        sql = "INSERT INTO tbl_mahasiswa VALUES (%s, %s, %s)"
        val = (nama, nim, jurusan)
        self.mycursor.execute(sql, val)
        self.mydb.commit()
        
        # Bersihkan text input
        self.ids.nama_input.text = ""
        self.ids.nim_input.text = ""
        self.ids.jurusan_input.text = ""
        self.show_Table()
    def show_table(self):
        self.mycursor.execute("SELECT * FROM tbl_mahasiswa")
        myresult = self.mycursor.fetchall()
        self.ids.table.clear_widgets()
        self.ids.table.add_widget(Label(text="Data Mahasiswa"))
        self.ids.tabel_mahasiswa.add_widget(Label(text="Nama", bold=True))
        self.ids.tabel_mahasiswa.add_widget(Label(text="Nim", bold=True))
        self.ids.tabel_mahasiswa.add_widget(Label(text="Jurusan", bold=True))
        
        for i in myresult:
            for item in i:
                self.ids.tabel_mahasiswa.add_widget(Label(text=item))
        
class form(App):
    def build(self):
        self.get_color_from_hex = get_color_from_hex # Utility Warna
        self.root_widget = InputForm()
        return self.root_widget
    def on_close(self):
        self.mydb.close()
        self.mycursor.close()
    def on_start(self):
        Window.size = (600, 600)
        self.title = "Formulir Pendaftaran Mahasiswa"
        self.icon = 'logo.png'
        self.root_widget.show_table()
    def on_stop(self):
        self.root_widget.on_close()
if __name__ == "__main__":
    form().run()