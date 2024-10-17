# Membuat simple Inheritance dg Method pass
# Membuat kelas superclass Animal
class Animal:
  # Membuat Construktor
  def __init__(self, name, age):
    self.name = name
    self.age = age
  # Membuat Methhod sound
  def sound(self):
    print(f"This {self.name} makes a sound")

# membuat kelas turunan / subclass Dog
class Dog(Animal):
  pass

name = input("masukan pets anda")
dog = Dog(name, 3)
dog.sound()
