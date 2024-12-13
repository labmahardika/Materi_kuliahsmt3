from kivy.app import App
from kivy.uix.boxlayout import BoxLayout
from kivy.uix.popup import Popup
from kivy.uix.label import Label
from kivy.uix.button import Button
from kivy.core.window import Window
from kivy.utils import get_color_from_hex
import mysql.connector

class InputForm(BoxLayout):
    def __init__(self, **kwargs):
        super().__init__(**kwargs)

        # Inisialisasi koneksi database
        self.mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="sikampus"
        )
        self.mycursor = self.mydb.cursor()

    def show_data(self):
        # Ambil data dari text input
        nama = self.ids.nama_input.text
        nim = self.ids.nim_input.text
        jurusan = self.ids.jurusan_input.text

        # Validasi inputan tidak kosong
        if not nama or not nim or not jurusan:
            popup = Popup(
                title="Error", 
                content=Label(text="Semua field harus diisi."),
                size_hint=(0.8, 0.4),
                auto_dismiss=True
            )
            popup.open()
            return

        # Insert data ke database
        sql = "INSERT INTO tbl_mahasiswa (nama, nim, jurusan) VALUES (%s, %s, %s)"
        val = (nama, nim, jurusan)
        try:
            self.mycursor.execute(sql, val)
            self.mydb.commit()
        except Exception as e:
            popup = Popup(
                title="Database Error",
                content=Label(text=f"Error: {e}"),
                size_hint=(0.8, 0.4),
                auto_dismiss=True
            )
            popup.open()
            return

        # Reset form menjadi kosong
        self.ids.nama_input.text = ""
        self.ids.nim_input.text = ""
        self.ids.jurusan_input.text = ""
        self.show_table()

    def show_table(self):
        # Ambil data dari database
        self.mycursor.execute("SELECT * FROM tbl_mahasiswa")
        data_mahasiswa = self.mycursor.fetchall()

        # Hapus widget di tabel sebelumnya
        self.ids.tabel_mahasiswa.clear_widgets()

        # Tambahkan header kolom
        self.ids.tabel_mahasiswa.add_widget(Label(text="Nama", bold=True, size_hint_x=None, width=140))
        self.ids.tabel_mahasiswa.add_widget(Label(text="NIM", bold=True, size_hint_x=None, width=140))
        self.ids.tabel_mahasiswa.add_widget(Label(text="Jurusan", bold=True, size_hint_x=None, width=140))

        # Tambahkan data ke tabel
        for row in data_mahasiswa:
            for item in row:
                self.ids.tabel_mahasiswa.add_widget(Label(text=item, size_hint_x=None, width=140))

    def on_close(self):
        # Menutup koneksi database saat aplikasi ditutup
        self.mycursor.close()
        self.mydb.close()


class form(App):
    def build(self):
        self.get_color_from_hex = get_color_from_hex  # Utility warna
        self.root_widget = InputForm()
        return self.root_widget

    def on_start(self):
        self.root_widget.show_table()

    def on_stop(self):
        # Panggil metode untuk menutup koneksi database
        self.root_widget.on_close()

if __name__ == "__main__":
    form().run()