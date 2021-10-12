CREATE TABLE ms_role (
    id_role int PRIMARY KEY AUTO_INCREMENT,
    nama_role varchar(255)
);

CREATE TABLE pegawai (
    id int PRIMARY KEY AUTO_INCREMENT,
    role_id int,
    kode_pegawai varchar(255),
    nama_pegawai varchar(255),
    alamat_pegawai text,
    nomor_telepon_pegawai varchar(255),
    FOREIGN KEY(role_id) REFERENCES ms_role(id_role)
);

CREATE TABLE ms_user (
    id int PRIMARY KEY AUTO_INCREMENT,
    id_user int,
    username varchar(255),
    password varchar(255),
    is_login int DEFAULT 0,
    login_date varchar(255),
    last_login varchar(255),
    FOREIGN KEY(id_user) REFERENCES pegawai(id)
);

CREATE TABLE gejala (
    id int PRIMARY KEY AUTO_INCREMENT,
    kode_gejala varchar(255),
    nama_gejala varchar(255),
    instrumen varchar(255)
);

CREATE TABLE kerusakan (
    id int PRIMARY KEY AUTO_INCREMENT,
    kode_kerusakan varchar(255),
    nama_kerusakan varchar(255)
);

CREATE TABLE aturan (
    id int PRIMARY KEY AUTO_INCREMENT,
    kode_gejala varchar(255),
    kode_kerusakan int,
    FOREIGN KEY(kode_kerusakan) REFERENCES kerusakan(id)
);

CREATE TABLE penyebab_kerusakan (
    id int PRIMARY KEY AUTO_INCREMENT,
    kode_kerusakan int,
    penyebab_kerusakan varchar(255),
    FOREIGN KEY(kode_kerusakan) REFERENCES kerusakan(id)
);

CREATE TABLE solusi_kerusakan (
    id int PRIMARY KEY AUTO_INCREMENT,
    kode_kerusakan int,
    solusi_kerusakan varchar(255),
    FOREIGN KEY(kode_kerusakan) REFERENCES kerusakan(id)
);

CREATE TABLE activity_log (
  id int PRIMARY KEY AUTO_INCREMENT,
  username varchar(255),
  ip_address varchar(255),
  activity_log varchar(255),
  activity_date varchar(255),
  parameters text,
  is_success int(11)
);

INSERT INTO ms_role VALUES (1, 'Super Admin'), (2, 'Admin'), (3, 'Customer Service'), (4, 'Teknisi');
INSERT INTO pegawai VALUES (1, 1, 'admin', 'admin', 'admin', '111');
INSERT INTO ms_user VALUES (1, 1, 'admin', MD5('user'), NULL, NULL, NULL);