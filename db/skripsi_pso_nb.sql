-- Tabel Untuk Authentikasi Sistem

CREATE TABLE ms_role (
    id_role int PRIMARY KEY AUTO_INCREMENT,
    nama_role varchar(255)
);

CREATE TABLE ms_user (
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(255),
    nama_user varchar(255),
    password varchar(255),
    role_id int,
    is_login int DEFAULT 0,
    login_date varchar(255),
    last_login varchar(255),
    FOREIGN KEY(role_id) REFERENCES ms_role(id_role)
);

CREATE TABLE data_latih (
    id int PRIMARY KEY AUTO_INCREMENT,
    nama_pasien varchar(255),
    alamat_pasien text,
    anak_ke int,
    tanggal_persalinan varchar(255),
    usia_ibu int,
    usia_kehamilan int,
    tinggi_badan int,
    bsc varchar(255),
    riwayat_obsteri varchar(255),
    paritas varchar(255),
    tekanan_darah varchar(255),
    letak_sungsang varchar(255),
    cpd varchar(255),
    plasenta_previa varchar(255),
    peb varchar(255),
    oligohidroamnion varchar(255),
    jarak_kelahiran int,
    power_ibu varchar(255),
    persalinan varchar(255)
);

CREATE TABLE data_uji (
    id int PRIMARY KEY AUTO_INCREMENT,
    nama_pasien varchar(255),
    alamat_pasien text,
    anak_ke int,
    tanggal_persalinan varchar(255),
    usia_ibu int,
    usia_kehamilan int,
    tinggi_badan int,
    bsc varchar(255),
    riwayat_obsteri varchar(255),
    paritas varchar(255),
    tekanan_darah varchar(255),
    letak_sungsang varchar(255),
    cpd varchar(255),
    plasenta_previa varchar(255),
    peb varchar(255),
    oligohidroamnion varchar(255),
    jarak_kelahiran int,
    power_ibu varchar(255),
    persalinan varchar(255)
);

CREATE TABLE data_latih_optimasi (
    id int PRIMARY KEY AUTO_INCREMENT,
    nama_pasien varchar(255),
    alamat_pasien text,
    anak_ke int,
    tanggal_persalinan varchar(255),
    usia_ibu float,
    usia_kehamilan float,
    tinggi_badan float,
    bsc float,
    riwayat_obsteri float,
    paritas float,
    tekanan_darah float,
    letak_sungsang float,
    cpd float,
    plasenta_previa float,
    peb float,
    oligohidroamnion float,
    jarak_kelahiran float,
    power_ibu float,
    fitness float,
    persalinan varchar(255),
    terpilih varchar(255),
);

CREATE TABLE data_uji_nb_optimize (
    id int PRIMARY KEY AUTO_INCREMENT,
    nama_pasien varchar(255),
    alamat_pasien text,
    anak_ke int,
    tanggal_persalinan varchar(255),
    usia_ibu int,
    usia_kehamilan int,
    tinggi_badan int,
    bsc varchar(255),
    riwayat_obsteri varchar(255),
    paritas varchar(255),
    tekanan_darah varchar(255),
    letak_sungsang varchar(255),
    cpd varchar(255),
    plasenta_previa varchar(255),
    peb varchar(255),
    oligohidroamnion varchar(255),
    jarak_kelahiran int,
    power_ibu varchar(255),
    persalinan varchar(255),
    prediksi_persalinan varchar(255),
    SC float,
    Normal float
);

CREATE TABLE data_uji_nb (
    id int PRIMARY KEY AUTO_INCREMENT,
    nama_pasien varchar(255),
    alamat_pasien text,
    anak_ke int,
    tanggal_persalinan varchar(255),
    usia_ibu int,
    usia_kehamilan int,
    tinggi_badan int,
    bsc varchar(255),
    riwayat_obsteri varchar(255),
    paritas varchar(255),
    tekanan_darah varchar(255),
    letak_sungsang varchar(255),
    cpd varchar(255),
    plasenta_previa varchar(255),
    peb varchar(255),
    oligohidroamnion varchar(255),
    jarak_kelahiran int,
    power_ibu varchar(255),
    persalinan varchar(255),
    prediksi_persalinan varchar(255),
    SC float,
    Normal float
);

CREATE TABLE attribute (
    id int PRIMARY KEY AUTO_INCREMENT,
    attribute_name varchar(255),
);

CREATE TABLE attribute_optimize (
    id int PRIMARY KEY AUTO_INCREMENT,
    attribute_key int,
    optimize_value float,
    FOREIGN KEY(attribute_key) REFERENCES attribute(attribute_id)
);

-- CREATE TABLE attribute_value (
--     id int PRIMARY KEY AUTO_INCREMENT,
--     attribute_key
-- )

INSERT INTO ms_role VALUES (1, 'Super Admin'), (2, 'Admin');
INSERT INTO ms_user VALUES (1, 'admin', 'admin', MD5('user'), 1, 0, NULL, NULL);