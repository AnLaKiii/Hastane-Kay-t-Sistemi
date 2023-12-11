CREATE TABLE Hasta(
HastaID int primary key identity(1,1),
TCKimlikNo bigint  unique check(TCKimlikNo BETWEEN 10000000000 AND 99999999999) not null,
HastaAdi varchar(50) not null,
Soyadi varchar(50) not null,
DogumTarihi date not null,
);

CREATE TABLE Sifre(
TCKimlikNo bigint not null,
Sifre char(20) CHECK(LEN(Sifre)>=8) not null,
);

CREATE TABLE Adres(
HastaID int not null,
Sehir varchar(30)not null,
Ilce  varchar(40)not null,
AcikAdres varchar(500) not null,
foreign key(HastaID) references Hasta(HastaID) ON DELETE CASCADE, 
);

CREATE TABLE BolumAdi(
BolumID int primary key identity(100,1),
BolumAdi varchar(100) not null,
);

CREATE TABLE Doktor(
DoktorID int primary key identity(75,1),
DTCKimlikNo bigint  unique check(DTCKimlikNo BETWEEN 10000000000 AND 99999999999) not null,
DoktorAdi varchar(50) not null,
DoktorSoyadi varchar(50) not null,
DoktorBolumID int not null,
foreign key(DoktorBolumId) references BolumAdi(BolumID) ON DELETE CASCADE, 
);

CREATE TABLE DSifre(
DTCKimlikNo bigint not null,
Sifre char(20) CHECK(LEN(Sifre)>=8) not null,
);

CREATE TABLE Randevu(
RandevuID int primary key identity(1000,1),
RandevuTarihi datetime,
HastaID int not null,
DoktorID int not null,
);

ALTER TABLE Randevu
add constraint  DoktorID
foreign key (DoktorID) references Doktor(DoktorID) ON DELETE CASCADE;

ALTER TABLE Randevu
add constraint HastaID
foreign key (HastaID) references Hasta(HastaID)ON DELETE CASCADE;

ALTER TABLE Sifre
add constraint TCKimlikNo
foreign key (TCKimlikNo) references Hasta(TCKimlikNo)ON DELETE CASCADE;

ALTER TABLE DSifre
add constraint DTCKimlikNo
foreign key (DTCKimlikNo) references Doktor(DTCKimlikNo) ON DELETE CASCADE;