def pangkat_rekursif(basis, pangkat): 
if pangkat == 0: 
return 1 
else: 
return basis * pangkat_rekursif(basis, pangkat - 1) 
basis = int(input("Masukkan bilangan: ")) 
pangkat = int(input("Masukkan pangkat: ")) 
hasil = pangkat_rekursif(basis, pangkat) 
print("Hasil:", hasil)