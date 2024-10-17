# Membuat superclass Animal
class Animal:
    def __init__(self, name, age):
        self.name = name
        self.age = age

# Membuat subclass Dog yang mewarisi dari Animal
class Dog(Animal):
    def __init__(self, name, age, ras):
      # Inisiasi variabel name dan age dari super class
        super().__init__(name, age)
        self.ras = ras
      #Membuat method untuk kelas Dog
    def speaksDog(self):
        print(f"Dog {self.name} from ras {self.ras} is barking")

# Membuat kelas turunan dari kelas Dog
class Cat(Dog):
    def __init__(self, name, age, ras, color):
      # inisiasi instance variabel dari kelas Dog
        super().__init__(name, age, ras)
        self.color = color
    def speaksCat(self):
        print(f"Cat {self.name} from ras {self.ras} is meowing")

dog1 = Dog("Buddy", 3, "Labrador")
dog1.speaksDog()
cat1 = Cat("Whiskers", 2, "Siamese", "Orange")
cat1.speaksCat()
  