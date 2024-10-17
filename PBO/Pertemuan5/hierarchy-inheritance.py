# Membuat Konsep Hierarchy Inheritance
# Membuat Kelas Parent / Super Class
class Vehicle:
    def __init__(self, merk, model, year):
        self.merk = merk
        self.model = model
        self.year = year
    def display_info(self):
        print(f"Vehicle: {self.year} {self.merk} {self.model}")

# Membuat kelas turunan 1
class Car(Vehicle):
    def __init__(self, merk, model, year, num_doors):
        super().__init__(merk, model, year)
        self.num_doors = num_doors
        # Membuat method untuk kelas Car
    def display_info(self):
        super().display_info()
        print(f"Doors: {self.num_doors}")
# Membuat kelas turunan 2
class Motorcycle(Vehicle):
    def __init__(self, merk, model, year, cc):
        super().__init__(merk, model, year)
        self.cc = cc
        # Membuat method untuk kelas Motorcycle
    def display_info(self):
        super().display_info()
        print(f"CC: {self.cc}")
# Membuat Objek dari kelas turunan Car
car1 = Car("Toyota", "Camry", 2022, 4)
car1.display_info()
# Membuat Objek dari Kelas turunan Motor
motorcycle1 = Motorcycle("Honda", "CBR", 2021, 500)
motorcycle1.display_info()