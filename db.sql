/*
SQLyog  v11.01 (32 bit)
MySQL - 5.7.14 : Database - spip
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `kuisioner_awal` */

DROP TABLE IF EXISTS `kuisioner_awal`;

CREATE TABLE `kuisioner_awal` (
  `id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tahun` year(4) DEFAULT NULL,
  `responden_id` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pemda_id` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `survai_awal_id` int(3) DEFAULT NULL,
  `p_id` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `jawaban` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survai_awal_id` (`survai_awal_id`),
  KEY `responden_id` (`responden_id`),
  CONSTRAINT `kuisioner_awal_ibfk_1` FOREIGN KEY (`survai_awal_id`) REFERENCES `ref_survai_awal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kuisioner_awal_ibfk_2` FOREIGN KEY (`responden_id`) REFERENCES `responden_kuisioner_awal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Table structure for table `kuisioner_awal_validasi` */

DROP TABLE IF EXISTS `kuisioner_awal_validasi`;

CREATE TABLE `kuisioner_awal_validasi` (
  `id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tahun` year(4) DEFAULT NULL,
  `responden_id` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pemda_id` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `survai_awal_id` int(3) DEFAULT NULL,
  `p_id` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `jawaban` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survai_awal_id` (`survai_awal_id`),
  KEY `responden_id` (`responden_id`),
  CONSTRAINT `kuisioner_awal_validasi_ibfk_1` FOREIGN KEY (`id`) REFERENCES `kuisioner_awal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Table structure for table `ref_sub_unsur` */

DROP TABLE IF EXISTS `ref_sub_unsur`;

CREATE TABLE `ref_sub_unsur` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_unsur` int(2) NOT NULL,
  `kd_sub_unsur` int(2) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kd_unsur` (`kd_unsur`),
  CONSTRAINT `ref_sub_unsur_ibfk_1` FOREIGN KEY (`kd_unsur`) REFERENCES `ref_unsur` (`kd_unsur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `ref_sub_unsur` */

insert  into `ref_sub_unsur`(`id`,`kd_unsur`,`kd_sub_unsur`,`name`) values (1,1,1,'Penegakan Integritas dan Nilai Etika'),(2,1,2,'Komitmen Terhadap Kompetensi'),(3,1,3,'Kepemimpinan yang kondusif'),(4,1,4,'Struktur Organisasi Sesuai Kebutuhan'),(5,1,5,'Pendelegasian Wewenang dan Tanggung Jawab yang Tepat'),(6,1,6,'Penyusunan dan Penerapan Kebijakan yang Sehat tentang Pembinaan SDM'),(7,1,7,'Perwujudan Peran APIP yang Efektif'),(8,1,8,'Hubungan Kerja yang Baik dengan Instansi Pemerintah Terkait'),(9,2,1,'Identifikasi Risiko'),(10,2,2,'Analisis Risiko'),(11,3,1,'Reviu Kinerja'),(12,3,2,'Pembinaan Sumber Daya Manusia'),(13,3,3,'Pengendalian atas Pengelolaan Sistem Informasi'),(14,3,4,'Pengendalian Fisik atas Aset'),(15,3,5,'Penetapan dan Reviu Indikator'),(16,3,6,'Pemisahan Fungsi'),(17,3,7,'Otorisasi Transaksi dan Kejadian Penting'),(18,3,8,'Pencatatan yang Akurat dan Tepat Waktu'),(19,3,9,'Pembatasan Akses atas Sumber Daya dan Catatan'),(20,3,10,'Akuntabilitas Pencatatan dan Sumber Daya'),(21,3,11,'Dokumentasi yang baik atas Sistem Pengendalian Intern (SPI) serta transaksi dan kejadian penting'),(22,4,1,'Informasi'),(23,4,2,'Penyelenggaraan Komunikasi yang Efektif'),(24,5,1,'Pemantauan Berkelanjutan'),(25,5,2,'Evaluasi Terpisah');

/*Table structure for table `ref_survai_awal` */

DROP TABLE IF EXISTS `ref_survai_awal`;

CREATE TABLE `ref_survai_awal` (
  `id` int(3) NOT NULL,
  `p_id` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `sub_unsur_id` int(3) DEFAULT NULL,
  `pertanyaan` text CHARACTER SET latin1 NOT NULL,
  `ref` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `p_id` (`p_id`),
  KEY `sub_unsur_id` (`sub_unsur_id`),
  CONSTRAINT `ref_survai_awal_ibfk_1` FOREIGN KEY (`sub_unsur_id`) REFERENCES `ref_sub_unsur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `ref_survai_awal` */

insert  into `ref_survai_awal`(`id`,`p_id`,`sub_unsur_id`,`pertanyaan`,`ref`) values (1,'P1-1',1,'Apakah   organisasi   (Kementerian/Lembaga/Pemda)   telah   memiliki   Aturan Perilaku (Kode Etik) yang ditetapkan secara formal oleh pimpinan organisasi (Kepala Lembaga untuk K/L dan Gubernur/Bupati/Walikota untuk Pemerintah Daerah)?',NULL),(2,'P1-2',1,'Apakah Aturan Perilaku (Kode Etik) organisasi tersebut telah dikomunikasikan kepada sebagian besar pegawai dalam unit kerja/unit organisasi Saudara?',NULL),(3,'P1-3',1,'Apakah  sebagian  besar  pegawai  dalam  unit  kerja/unit  organisasi  Saudara berperilaku sesuai dengan Aturan Perilaku (Kode Etik) organisasi?',NULL),(4,'P1-4',1,'Apakah pimpinan organisasi/unit-organisasi/unit kerja telah melakukan\npemantauan/evaluasi penerapan Aturan Perilaku (Kode Etik) secara berkala dan terdokumentasi?',NULL),(5,'P1-5',1,'Apakah Aturan Perilaku (Kode Etik) organisasi dikembangkan terus menerus sesuai perubahan yang terjadi, dan telah dilakukan pemantauan secara otomatis oleh pimpinan organisasi atas penerapan aturan perilaku organisasi?',NULL),(6,'P2-1',2,'Apakah organisasi telah memiliki standar kompetensi  atas setiap tugas dan\nfungsi untuk masing-masing posisi yang ditetapkan secara formal oleh pimpinan organisasi?',NULL),(7,'P2-2',2,'Apakah standar kompetensi atas setiap tugas dan fungsi untuk masing-masing\nposisi tersebut telah dikomunikasikan kepada sebagian besar pegawai dalam unit kerja/unit organisasi Saudara?',NULL),(8,'P2-3',2,'Apakah promosi/mutasi pejabat telah berdasarkan standar kompetensi?',NULL),(9,'P2-4',2,'Apakah pimpinan organisasi telah melakukan pemantauan/evaluasi atas standar\nkompetensi dan kesesuaian penempatan pejabat dengan standar kompetensi secara berkala dan terdokumentasi?',NULL),(10,'P2-5',2,'Apakah standar kompetensi  dikembangkan  terus  menerus  sesuai  perubahan\nyang  terjadi,  dan  ada  sarana  pemantauan  secara  otomatis  oleh  pimpinan organisasi atas kesesuaian penempatan pejabat dengan standar kompetensi?',NULL),(11,'P3-1',3,'Apakah organisasi telah memiliki  kebijakan/prosedur Sistem Manajemen Kinerja\n(SMK),  misalnya  prosedur  penerapan  Sistem  Akuntabilitas  Kinerja  Instansi Pemerintah (SAKIP)?',NULL),(12,'P3-2',3,'Apakah kebijakan/prosedur SMK telah dikomunikasikan kepada seluruh tingkat\npimpinan dan pegawai terkait dalam unit organisasi/unit kerja Saudara?',NULL),(13,'P3-3',3,'Apakah kebijakan/prosedur SMK telah diberlakukan/diimplementasikan kepada\nunit organisasi/unit kerja Saudara?',NULL),(14,'P3-4',3,'Apakah  pimpinan  organisasi  / unit-organisasi /  unit  kerja  telah  mengevaluasi\nkebijakan/prosedur    SMK    dan    implementasinya    secara    berkala    dan terdokumentasi?',NULL),(15,'P3-5',3,'Apakah kebijakan/prosedur SMK dikembangkan terus menerus sesuai dengan\nperubahan yang terjadi dan telah dilakukan pemantauan secara otomatis/online oleh pimpinan organisasi ?',NULL),(16,'P4-1',4,'Apakah organisasi/ unit-organisasi/ unit kerja Saudara telah memiliki Struktur\nOrganisasi beserta uraian tata laksananya mengacu pada peraturan perundang- undangan yang berlaku?',NULL),(17,'P4-2',4,'Apakah keberadaan Struktur Organisasi beserta uraian tata laksananya, baik\npada organisasi/ unit-organisasi/ unit kerja, telah dikomunikasikan kepada level pimpinan dan pegawai yang berkepentingan?',NULL),(18,'P4-3',4,'Apakah Struktur Organisasi beserta uraian tata laksananya pada organisasi /\nunit-organisasi  /  unit  kerja  Saudara  telah  sesuai  dengan  ukuran  dan  sifat kegiatannya?',NULL),(19,'P4-4',4,'Apakah Struktur Organisasi beserta uraian tata laksananya pada organisasi /\nunit-organisasi  /  unit  kerja  Saudara  telah  dievaluasi  secara  berkala  dan terdokumentasi?',NULL),(20,'P4-5',4,'Apakah  Struktur  Organisasi  beserta  uraian  tata  laksananya  dimutakhirkan\nsesuai perubahan lingkungan strategis dan telah dilakukan pemantauan secara\notomatis/online oleh pimpinan organisasi?',NULL),(21,'P5-1',5,'Apakah terdapat prosedur pendelegasian wewenang yang dibuat secara formal di\norganisasi/ unit-organisasi/ unit kerja Saudara?',NULL),(22,'P5-2',5,'Apakah prosedur  pendelegasian wewenang  di organisasi/ unit-organisasi/  unit\nkerja Saudara telah dikomunikasikan kepada sebagian besar pegawai?',NULL),(23,'P5-3',5,'Apakah prosedur  pendelegasian wewenang  di organisasi/ unit-organisasi/  unit\nkerja Saudara telah dilaksanakan dan didokumentasikan?',NULL),(24,'P5-4',5,'Apakah  pimpinan  organisasi  /  unit-organisasi  /  unit  kerja  Saudara  telah\nmelakukan   evaluasi   atas   prosedur   pendelegasian   wewenang   dan   hasil pelaksanaan pendelegasian wewenang secara berkala dan terdokumentasi?',NULL),(25,'P5-5',5,'Apakah  prosedur  pendelegasian  wewenang  terus  menerus  disesuaikan  dengan\nperubahan lingkungan strategis yang terjadi, dan atas pelaksanaan pendelegasian wewenang telah dilakukan pemantauan otomatis/online oleh pimpinan organisasi / unit-organisasi /',NULL),(26,'P6-1',6,'Apakah   organisasi   telah   memiliki   serangkaian   kebijakan/aturan   mengenai\npembinaan Sumber Daya Manusia (SDM) sejak rekrutmen s.d. pemberhentian?',NULL),(27,'P6-2',6,'Apakah  kebijakan/aturan  pembinaan  SDM  tersebut  telah  dikomunikasikan\nkepada pegawai pada unit kerja Saudara?',NULL),(28,'P6-3',6,'Apakah rekrutmen, pembinaan pegawai sampai dengan pemberhentiannya pada\nunit kerja Saudara telah dilakukan sesuai dengan kebijakan/aturan pembinaan SDM dan didokumentasikan?',NULL),(29,'P6-4',6,'Apakah  pimpinan  organisasi/  unit  organisasi/  unit  kerja  Saudara  telah\nmelakukan evaluasi atas kebijakan pembinaan SDM,  dan  kesesuaian pelaksanaan rekrutmen, pembinaan pegawai sampai dengan pemberhentiannya dengan kebijakan/aturan pembinaan SDM s',NULL),(30,'P6-5',6,'Apakah   kebijakan/aturan   pembinaan   SDM   dan   pelaksanaan   rekrutmen,\npembinaan pegawai sampai dengan pemberhentiannya dikembangkan terus menerus sesuai dengan perubahan lingkungan strategis yang terjadi, dan telah dilakukan pemantauan otomatis/onl',NULL),(31,'P7-1',7,'Apakah   satuan   pengawasan   intern   (inspektorat/inspektorat   jenderal)   yang\ndibentuk telah memiliki piagam audit atau kebijakan pengawasan atau dokumen formal lain yang menyatakan visi, misi, tujuan, wewenang, tanggung jawab kegiatan audit intern ',NULL),(32,'P7-2',7,'Apakah piagam audit atau kebijakan pengawasan atau dokumen formal lainnya tersebut telah dikomunikasikan kepada unit kerja Saudara?',NULL),(33,'P7-3',7,'Apakah inspektorat/itjen telah dapat memberikan keyakinan yang memadai atas\nketaatan, kehematan, efisiensi, efektivitas, pencapaian tujuan penyelenggaraan tugas dan fungsi organisasi/unit organisasi/unit kerja?',NULL),(34,'P7-4',7,'Apakah   kinerja   pengawasan   inspektorat/itjen   di   organisasi   Saudara   telah\ndilakukan penilaian internal dan eksternal (penelaahan sejawat oleh aparat pengawasan lain) dan hasilnya telah ditindaklanjuti dalam rangka meningkatkan keyakinan yang m',NULL),(35,'P7-5',7,'Apakah inspektorat/itjen telah dapat memberikan peringatan dini bagi pimpinan organisasi/unit organisasi/unit kerja dan meningkatkan efektivitas manajemen risiko dalam penyelenggaraan tugas dan fungsi organisasi/unit organisasi/unit kerja, dan telah dilak',NULL),(36,'P8-1',8,'Apakah organisasi telah memiliki pedoman/kebijakan/SOP terkait dengan tugas\ndan fungsi unit organisasi/ unit kerja Saudara yang melibatkan unit organisasi/ unit kerja lain terkait dengan mekanisme saling uji (pencocokan data dengan unit kerja/unit organis',NULL),(37,'P8-2',8,'Apakah pedoman/kebijakan terkait dengan tugas dan fungsi unit organisasi/ unit\nkerja Saudara, yang melibatkan unit organisasi/ unit kerja lain tersebut, telah dikomunikasikan kepada pegawai yang berkepentingan dalam unit organisasi/ unit kerja Saudara?',NULL),(38,'P8-3',8,'Apakah  kebijakan/prosedur  koordinasi  dengan  unit  organisasi/unit  kerja  lain\ntelah diimplementasikan oleh pegawai  yang berkepentingan di setiap jenjang level unit kerja dan didokumentasikan?',NULL),(39,'P8-4',8,'Apakah  pimpinan  di  setiap  jenjang  level  unit  kerja  telah  melakukan  evaluasi\nterhadap pemberlakuan kebijakan/prosedur mekanisme saling uji data dengan unit organisasi/ unit kerja lain secara berkala dan terdokumentasi?',NULL),(40,'P8-5',8,'Apakah mekanisme saling uji data telah dikembangkan secara terus menerus\nsesuai    dengan    kebutuhan    dan    telah    dilakukan    pemantauan    secara otomatis/online oleh pimpinan organisasi?',NULL),(41,'P9-1',9,'Apakah organisasi/ unit-organisasi telah memiliki kebijakan/pedoman penilaian\nrisiko   (identifikasi   risiko)   yang   ditetapkan   secara   formal   oleh   pimpinan organisasi/ unit-organisasi atau pedoman penilaian risiko formal lainnya?',NULL),(42,'P9-2',9,'Apakah  kebijakan/pedoman  penilaian  risiko  (identifikasi  risiko)  tersebut  telah\ndikomunikasikan   kepada   pegawai   yang   berkepentingan   di   organisasi/unit organisasi/unit  kerja  Saudara?',NULL),(43,'P9-3',9,'Apakah organisasi/ unit-organisasi/unit kerja  Saudara telah  memiliki daftar\nrisiko  atas  kegiatan  utama  yang  ditetapkan  secara  formal  oleh  pimpinan organisasi/ unit-organisasi?',NULL),(44,'P9-4',9,'Apakah pimpinan di setiap jenjang level unit kerja telah melakukan evaluasi terhadap kebijakan/pedoman penilaian risiko (identifikasi risiko) dan pelaksanaannya serta daftar risiko yang dibuat secara berkala dan terdokumentasi?',NULL),(45,'P9-5',9,'Apakah daftar risiko telah dimutakhirkan secara terus menerus sesuai dengan\nperubahan    kebutuhan    atau    harapan    stakeholders    dan    telah    dilakukan pemantauan otomatis/online oleh pimpinan organisasi?',NULL),(46,'P10-1',10,'Apakah    organisasi/    unit-organisasi    telah    memiliki    kebijakan/pedoman\npenilaian risiko (analisis risiko) yang ditetapkan secara formal oleh pimpinan organisasi/ unit-organisasi atau pedoman penilaian risiko formal lainnya?',NULL),(47,'P10-2',10,'Apakah     pedoman     penilaian     risiko     (analisis     risiko)     tersebut     telah\ndikomunikasikan   kepada   pegawai   yang   berkepentingan   di   organisasi/unit organisasi /unit kerja Saudara?',NULL),(48,'P10-3',10,'Apakah  organisasi/unit  organisasi/unit  kerja  telah  memiliki  rencana  tindak\npengendalian/rencana penanganan risiko atas kegiatan utama yang ditetapkan secara formal oleh pimpinan organisasi/unit organisasi dan RTP telah diiplementasikan?',NULL),(49,'P10-4',10,'Apakah   pimpinan   telah   melakukan   evaluasi   atas       rencana   tindak\npengendalian/rencana   penanganan   risiko   tersebut   secara   berkala   dan terdokumentasi?',NULL),(50,'P10-5',10,'Apakah   rencana   tindak   pengendalian/rencana   penanganan   risiko   telah\ndimutakhirkan secara terus menerus sesuai dengan perubahan  kebutuhan atau harapan stakeholders dan  telah dilakukan pemantauan otomatis/online oleh pimpinan organisasi atas re',NULL),(51,'P11-1',11,'Apakah organisasi/unit organisasi/ unit kerja Saudara telah memiliki dokumen\npenetapan kinerja (PK/ Tapkin) yang ditetapkan secara formal?',NULL),(52,'P11-2',11,'Apakah     dokumen     penetapan     kinerja     (PK/     Tapkin)     tersebut     telah dikomunikasikan kepada seluruh pegawai yang berkepentingan?',NULL),(53,'P11-3',11,'Apakah organisasi/unit organisasi/ unit kerja Saudara telah melakukan reviu\nkinerja   berdasarkan   tolok   ukur   kinerja   yang   ditetapkan   dalam   dokumen penetapan kinerja (PK/ Tapkin)?',NULL),(54,'P11-4',11,'Apakah  pimpinan  organisasi/  unit-organisasi/  unit  kerja  telah  melakukan\nevaluasi atas kinerja dan menggunakan hasilnya untuk memperbaiki cara/metode pelaksanaan kegiatan untuk efisiensi dan efektivitas pencapaian kinerja secara berkala dan terdokum',NULL),(55,'P11-5',11,'Apakah   cara/metode   pelaksanaan   kegiatan   dikembangkan   terus   menerus\nsesuai dengan perubahan untuk meningkatkan kinerja, dan telah dilakukan pemantauan otomatis/online oleh pimpinan organisasi atas kinerja organisasi/ unit organisasi/ unit kerja',NULL),(56,'P12-1',12,'Apakah  organisasi  Saudara  telah  memiliki  kebijakan/SOP  terkait  pembinaan\nsumber daya manusia (kebutuhan jumlah, persyaratan jabatan, dan standar kinerja pegawai)?',NULL),(57,'P12-2',12,'Apakah kebijakan/SOP tentang pembinaan sumber daya manusia (kebutuhan\njumlah, persyaratan jabatan, dan standar kinerja pegawai)  telah dikomunikasikan kepada pejabat/pegawai yang berkepentingan di unit kerja Saudara?',NULL),(58,'P12-3',12,'Apakah  pembinaan  sumber  daya  manusia  di  organisasi/unit  kerja  Saudara\ntelah   sesuai   dengan   kebijakan/SOP   pembinaan   sumber   daya   manusia (kebutuhan jumlah, persyaratan jabatan, dan standar kinerja pegawai)?',NULL),(59,'P12-4',12,'Apakah pimpinan organisasi/ unit organisasi/ unit  kerja telah  melakukan\npemantauan/evaluasi      secara      berkala      dan      terdokumentasi      atas pemberlakuan/implementasi pembinaan sumber daya manusia tersebut?',NULL),(60,'P12-5',12,'Apakah pembinaan sumber daya manusia (kebutuhan jumlah, persyaratan\njabatan, dan standar kinerja pegawai) telah dikembangkan secara terus menerus sesuai dengan perubahan kebutuhan dan telah dilakukan pemantauan otomatis/online oleh pimpinan organisasi ata',NULL),(61,'P13-1',13,'Apakah organisasi/ unit organisasi/unit kerja telah memiliki kebijakan/SOP yg\nmemuat pengendalian umum (untuk menjamin sistem informasi  siap digunakan) dan pengendalian aplikasi (untuk menjamin validitas, kelengkapan, dan akurasi data) sistem informasi?',NULL),(62,'P13-2',13,'Apakah  kebijakan  dan  prosedur  tersebut  telah  dikomunikasikan  kepada\npegawai yg berkepentingan di unit organisasi/ unit kerja Saudara?',NULL),(63,'P13-3',13,'Apakah pengendalian umum dan pengendalian aplikasi sistem informasi telah\ndilaksanakan sesuai dengan kebijakan/SOP dan didokumentasikan?',NULL),(64,'P13-4',13,'Apakah  pimpinan  organisasi/  unit  organisasi/unit  kerja  melakukan  evaluasi\natas pengendalian umum dan pengendalian aplikasi sistem informasi yang digunakan organisasi/ unit organisasi/ unit kerja secara berkala dan terdokumentasi?',NULL),(65,'P13-5',13,'Apakah   pengendalian   umum   dan   pengendalian   aplikasi   sistem   informasi\ndikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan organisasi/unit organisasi/ unit',NULL),(66,'P14-1',14,'Apakah organisasi/unit organisasi/ unit kerja Saudara telah memiliki aturan\nterkait            dengan            pengamanan            aset            (misal            dari pencurian/kerusakan/penyimpangan penggunaan aset)?',NULL),(67,'P14-2',14,'Apakah   aturan   tersebut   telah   dikomunikasikan   kepada       pegawai   yang\nberkepentingan di unit organisasi/ unit kerja Saudara?',NULL),(68,'P14-3',14,'Apakah unit organisasi/ unit kerja Saudara telah melaksanakan pengamanan\nfisik atas aset sesuai dengan aturan yang ditetapkan dan didokumentasikan?',NULL),(69,'P14-4',14,'Apakah  pimpinan  organisasi/unit  organisasi/  unit  kerja  Saudara  telah\nmelakukan   evaluasi   atas   pengamanan   fisik   aset   secara   berkala   dan terdokumentasi?',NULL),(70,'P14-5',14,'Apakah aturan dan pengamanan fisik atas aset dikembangkan secara terus\nmenerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan unit organisasi/ unit kerja Saudara atas pengamanan aset?',NULL),(71,'P15-1',15,'Apakah organisasi/ unit organisasi/ unit kerja Saudara telah memiliki indikator\nkinerja utama (IKU) yang ditetapkan secara formal oleh pimpinan organisasi?',NULL),(72,'P15-2',15,'Apakah    IKU    tersebut    telah    dikomunikasikan    kepada    pegawai    yang\nberkepentingan di unit kerja Saudara?',NULL),(73,'P15-3',15,'Apakah   IKU   telah   digunakan   untuk   mengukur   kinerja   organisasi/   unit\norganisasi/ unit kerja Saudara?',NULL),(74,'P15-4',15,'Apakah pimpinan organisasi/ unit organisasi/ unit  kerja telah  melakukan evaluasi atas IKU secara berkala dan terdokumentasi?',NULL),(75,'P15-5',15,'Apakah IKU dikembangkan terus menerus sesuai dengan perubahan strategis/\nperubahan tugas dan fungsi serta mandat organisasi?',NULL),(76,'P16-1',16,'Apakah organisasi/ unit organisasi/ unit kerja telah secara formal memisahkan\ntanggung jawab dan tugas untuk menjamin bahwa seluruh aspek utama transaksi atau kejadian tidak dikendalikan oleh 1 (satu) orang yang berpotensi terjadinya kecurangan?',NULL),(77,'P16-2',16,'Apakah kebijakan terhadap pemisahan tanggung jawab dan tugas tersebut\ntelah dikomunikasikan kepada pegawai yang berkepentingan di unit organisasi/ unit kerja Saudara?',NULL),(78,'P16-3',16,'Apakah pemisahan tanggung jawab dan tugas tersebut telah diterapkan di unit\norganisasi/ unit kerja Saudara?',NULL),(79,'P16-4',16,'Apakah setiap level pimpinan  di unit organisasi/ unit kerja telah  melakukan\npemantauan/evaluasi atas penerapan pemisahan tanggung jawab dan tugas tersebut secara berkala dan terdokumentasi?',NULL),(80,'P16-5',16,'Apakah kebijakan terkait pemisahan tanggung jawab dan tugas tersebut telah\ndikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan unit organisasi/ unit kerja?',NULL),(81,'P17-1',17,'Apakah   organisasi/   unit   organisasi/   unit   kerja   Saudara   telah   memiliki\naturan/pedoman/SOP yang memuat tentang otorisasi atas  transaksi  dan kejadian penting (antara lain: keuangan, barang, kepegawaian, perijinan, dan pendapatan)?',NULL),(82,'P17-2',17,'Apakah  aturan/pedoman/SOP  yang  memuat  tentang  otorisasi  atas  transaksi\ndan  kejadian  penting  tersebut  telah  dikomunikasikan  kepada  pegawai  yang berkepentingan di unit organisasi/ unit kerja Saudara?',NULL),(83,'P17-3',17,'Apakah otorisasi transaksi dan kejadian penting di unit organisasi/ unit kerja\nSaudara   telah   dilaksanakan   sesuai   dengan   aturan/pedoman/SOP   dan didokumentasikan?',NULL),(84,'P17-4',17,'Apakah pimpinan organisasi/ unit organisasi/ unit  kerja telah  melakukan\npemantauan/evaluasi atas otorisasi transaksi dan kejadian penting tersebut secara berkala dan terdokumentasi?',NULL),(85,'P17-5',17,'Apakah aturan/pedoman/SOP yang memuat otorisasi  transaksi dan kejadian\npenting, dan pelaksanaannya dikembangkan terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan unit organisasi/ unit',NULL),(86,'P18-1',18,'Apakah organisasi/ unit organisasi/ unit kerja Saudara telah memiliki aturan/pedoman terkait kewajiban pencatatan transaksi dan kejadian secara akurat dan tepat waktu?',NULL),(87,'P18-2',18,'Apakah aturan/pedoman tersebut telah dikomunikasikan kepada pegawai yang\nberkepentingan di unit organisasi/ unit kerja Saudara?',NULL),(88,'P18-3',18,'Apakah transaksi dan kejadian penting pada unit kerja Saudara telah dicatat\nsecara akurat dan tepat sesuai aturan/pedoman?',NULL),(89,'P18-4',18,'Apakah  pimpinan  organisasi/unit  organisasi/  unit  kerja  Saudara  telah\nmelakukan  evaluasi  atas pencatatan transaksi dan  kejadian penting  secara berkala dan terdokumentasi?',NULL),(90,'P18-5',18,'Apakah  aturan/pedoman terkait kewajiban  pencatatan  transaksi dan kejadian\npenting serta pelaksanaannya telah dikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan un',NULL),(91,'P19-1',19,'Apakah  akses  atas  sumber  daya  (misalnya:  aset,  uang,  dll)  dan  catatan\n(misalnya: SIMDA, SIMPEG, dll) di unit kerja Saudara telah dibatasi pada pegawai yang berwenang yang ditetapkan secara formal oleh pimpinan organisasi/unit organisasi/ unit ke',NULL),(92,'P19-2',19,'Apakah pembatasan akses atas sumber daya dan catatan di unit kerja Saudara\ntersebut telah dikomunikasikan kepada pegawai yang berkepentingan di unit organisasi/ unit kerja Saudara?',NULL),(93,'P19-3',19,'Apakah akses pada sumber daya dan catatan di unit kerja Saudara hanya\ndilakukan oleh petugas yang ditetapkan sehingga menjamin keamanan sumber daya dan catatan dari pencurian/kerusakan/penyimpangan?',NULL),(94,'P19-4',19,'Apakah  pimpinan  di  unit  organisasi/  unit  kerja  Saudara  telah  melakukan\nevaluasi  terhadap  pembatasan  akses atas sumber daya dan  catatan  secara berkala dan terdokumentasi?',NULL),(95,'P19-5',19,'Apakah pembatasan akses atas sumber daya dan catatan telah dikembangkan\nsecara terus menerus sesuai dengan perubahan lingkungan strategis?',NULL),(96,'P20-1',20,'Apakah penanggung jawab sumber daya dan catatan beserta uraian tugasnya di\nunit    kerja   Saudara   telah   ditetapkan    secara   formal    oleh   pimpinan organisasi/unit organisasi/ unit kerja?',NULL),(97,'P20-2',20,'Apakah penetapan penanggung jawab sumber daya dan catatan beserta uraian\ntugasnya di unit kerja Saudara tersebut telah dikomunikasikan kepada pegawai yang  berkepentingan?',NULL),(98,'P20-3',20,'Apakah   penanggung   jawab   sumber   daya   dan   catatan   telah   membuat\npertanggungjawaban  atas  sumber  daya  dan  catatan  sesuai  dengan  yang ditentukan?',NULL),(99,'P20-4',20,'Apakah  pimpinan  di  unit  organisasi/  unit  kerja  Saudara  telah  melakukan\npemantauan/evaluasi atas akuntabilitas pencatatan dan sumber daya tersebut secara berkala dan terdokumentasi?',NULL),(100,'P20-5',20,'Apakah    akuntabilitas    pencatatan    dan    sumber    daya    tersebut    telah\ndikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan unit organisasi/ unit kerja Sa',NULL),(101,'P21-1',21,'Apakah organisasi/unit organisasi/ unit kerja Saudara telah memiliki kebijakan/prosedur untuk melakukan dokumentasi atas implementasi/penyelenggaraan SPI serta transaksi dan kejadian penting?',NULL),(102,'P21-2',21,'Apakah kebijakan/prosedur tersebut telah dikomunikasikan ke pegawai yang\nberkepentingan?',NULL),(103,'P21-3',21,'Apakah dokumentasi  atas implementasi SPI  serta transaksi dan kejadian\npenting telah dilakukan sesuai kebijakan yang ditetapkan?',NULL),(104,'P21-4',21,'Apakah pimpinan organisasi/ unit organisasi/ unit kerja telah melakukan\nevaluasi atas kebijakan/prosedur dan pelaksanaan kebijakan pendokumentasian implementasi SPI serta transaksi dan kejadian penting secara berkala dan terdokumentasi?',NULL),(105,'P21-5',21,'Apakah kebijakan/prosedur untuk melakukan dokumentasi atas implementasi\nSPI serta transaksi dan kejadian penting dikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online  oleh pimpinan ',NULL),(106,'P22-1',22,'Apakah  organisasi/  unit  organisasi/   unit  kerja     Saudara  telah   memiliki\nkebijakan / prosedur atau pedoman  infokom / kehumasan  untuk memperoleh informasi yang penting dalam mencapai tujuan Instansi Pemerintah?',NULL),(107,'P22-2',22,'Apakah kebijakan-kebijakan / prosedur tersebut telah dikomunikasikan kepada\npegawai yang berkepentingan di unit organisasi/ unit kerja Saudara?',NULL),(108,'P22-3',22,'Apakah  informasi  yang  relevan, akurat,  dan  tepat  waktu  dapat  diakses  oleh\npegawai  yang  berkepentingan/terkait  sehingga  memungkinkan  dilakukan pengecekan/ pemantauan dan tindakan korektif secara tepat?',NULL),(109,'P22-4',22,'Apakah proses identifikasi, perolehan, dan distribusi informasi operasional dan\nkeuangan mampu untuk mengukur pencapaian  rencana kinerja strategis serta telah dievaluasi secara berkala dan terdokumentasi?',NULL),(110,'P22-5',22,'Apakah proses identifikasi, perolehan, dan distribusi informasi operasional dan\nkeuangan/ anggaran telah dikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan unit orga',NULL),(111,'P23-1',23,'Apakah   organisasi/   unit   organisasi/   unit   kerja   Saudara   telah   memiliki\nkebijakan/ SOP/ pedoman untuk menjelaskan pentingnya pengendalian intern dan tugas serta tanggungjawab masing-masing pegawai?',NULL),(112,'P23-2',23,'Apakah   kebijakan/   SOP/pedoman   komunikasi   internal   &   eksternal   telah\ndikomunikaskan kepada manajemen, pegawai, dan stakeholder terkait di unit organisasi/ unit kerja Saudara?',NULL),(113,'P23-3',23,'Apakah  pimpinan  unit  organisasi/  unit  kerja  telah  menyediakan  berbagai\nbentuk  sarana  komunikasi,  baik  untuk  internal  dan  eksternal  yang  dapat dimanfaatkan oleh manajemen dan seluruh personil pelaksana kegiatan?',NULL),(114,'P23-4',23,'Apakah  setiap  level  pimpinan  di  unit  organisasi/  unit  kerja  Saudara  telah\nmelakukan  pemantauan/evaluasi  atas  kebijakan/  SOP/  pedoman  tersebut secara berkala dan terdokumentasi?',NULL),(115,'P23-5',23,'Apakah    upaya    pengembangan/    pembaharuan    sistem    informasi    untuk\nmeningkatkan kegunaan dan keandalan komunikasi informasi telah dilakukan secara terus menerus, dan telah dilakukan pemantauan otomatis/online oleh pimpinan unit organisasi/ un',NULL),(116,'P24-1',24,'Apakah organisasi/ unit organisasi/ unit kerja Saudara telah memiliki strategi/\nkebijakan / prosedur pemantauan berkelanjutan (supervisi kegiatan, pembandingan, rekonsiliasi, sidak,  dan  prosedur  lain)  untuk  meyakinkan bahwa aktivitas pengendalian tel',NULL),(117,'P24-2',24,'Apakah  strategi/  kebijakan  /  prosedur  pemantauan  berkelanjutan    telah\ndikomunikaskan kepada manajemen dan pegawai yang berkepentingan?',NULL),(118,'P24-3',24,'Apakah setiap level pimpinan  di unit organisasi/ unit kerja telah  melakukan\npemantauan berkelanjutan atas efektivitas kegiatan pengendalian pada tingkat entitas dan tingkat kegiatan (seluruh kegiatan) dengan melibatkan manajemen dan seluruh personil pel',NULL),(119,'P24-4',24,'Apakah setiap level pimpinan dalam organisasi/ unit-organisasi/ unit kerja\ntelah melakukan evaluasi pemantauan berkelanjutan atas efektivitas kegiatan pengendalian secara berkala dan terdokumentasi?',NULL),(120,'P24-5',24,'Apakah strategi/ kebijakan / prosedur pemantauan berkelanjutan atas efektivitas kegiatan pengendalian tersebut telah dikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis secara otomatis/online oleh pimpinan unit organisasi/ unit ',NULL),(121,'P25-1',25,'Apakah    organisasi    telah    memiliki    kebijakan/pedoman/prosedur    untuk\nmelakukan evaluasi pengendalian intern secara terpisah yang ditetapkan secara formal oleh pimpinan organisasi?\nEvaluasi terpisah adalah penilaian atas mutu kinerja Sistem Pen',NULL),(122,'P25-2',25,'Apakah kebijakan/pedoman/prosedur untuk melakukan evaluasi pengendalian\nintern secara terpisah, telah dikomunikaskan kepada manajemen dan pegawai yang berkepentingan di unit kerja Saudara?',NULL),(123,'P25-3',25,'Apakah  organisasi/  unit-organisasi  /  unit  kerja  Saudara  telah  melakukan\nevaluasi pengendalian intern secara terpisah dengan melibatkan manajemen dan pegawai terkait yang berkompeten?',NULL),(124,'P25-4',25,'Apakah  telah  dilakukan  evaluasi  atas  kebijakan/pedoman/prosedur  untuk\nmelakukan evaluasi pengendalian intern secara terpisah disesuaikan dengan regulasi terkait, secara berkala dan terdokumentasi?',NULL),(125,'P25-5',25,'Apakah kebijakan/pedoman/prosedur untuk melakukan evaluasi pengendalian intern secara terpisah telah dikembangkan secara terus menerus sesuai dengan perubahan lingkungan strategis, dan telah dilakukan pemantauan otomatis/online oleh pimpinan unit organisa',NULL);

/*Table structure for table `ref_unsur` */

DROP TABLE IF EXISTS `ref_unsur`;

CREATE TABLE `ref_unsur` (
  `kd_unsur` int(2) NOT NULL,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`kd_unsur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Data for the table `ref_unsur` */

insert  into `ref_unsur`(`kd_unsur`,`name`) values (1,'Lingkungan Pengendalian'),(2,'Penilaian Risiko'),(3,'Kegiatan Pengendalian'),(4,'Informasi dan Komunikasi'),(5,'Pemantauan');

/*Table structure for table `responden_kuisioner_awal` */

DROP TABLE IF EXISTS `responden_kuisioner_awal`;

CREATE TABLE `responden_kuisioner_awal` (
  `id` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tahun` year(4) DEFAULT NULL,
  `pemda_id` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `nama_unit` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nama` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `nip` varchar(18) COLLATE latin1_general_ci DEFAULT NULL,
  `jabatan` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `secret_key` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `kategori_jabatan` tinyint(1) DEFAULT NULL COMMENT '1 => Es.1 2=> Es.2 3=> Es.3 4=> Es.4 5=> Staff',
  `post` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

/*Table structure for table `questions_list` */

DROP TABLE IF EXISTS `questions_list`;

/*!50001 DROP VIEW IF EXISTS `questions_list` */;
/*!50001 DROP TABLE IF EXISTS `questions_list` */;

/*!50001 CREATE TABLE  `questions_list`(
 `kd_unsur` int(2) ,
 `nama_unsur` varchar(255) ,
 `kd_sub_unsur` int(2) ,
 `id_sub_unsur` int(3) ,
 `nama_sub_unsur` varchar(255) ,
 `id` int(3) ,
 `p_id` varchar(50) ,
 `pertanyaan` text 
)*/;

/*Table structure for table `rekapitulasi_survai_awal` */

DROP TABLE IF EXISTS `rekapitulasi_survai_awal`;

/*!50001 DROP VIEW IF EXISTS `rekapitulasi_survai_awal` */;
/*!50001 DROP TABLE IF EXISTS `rekapitulasi_survai_awal` */;

/*!50001 CREATE TABLE  `rekapitulasi_survai_awal`(
 `id` int(3) ,
 `name` varchar(255) ,
 `p_id` varchar(50) ,
 `pertanyaan` text ,
 `responden_id` varchar(100) ,
 `jawaban` tinyint(1) 
)*/;

/*View structure for view questions_list */

/*!50001 DROP TABLE IF EXISTS `questions_list` */;
/*!50001 DROP VIEW IF EXISTS `questions_list` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `questions_list` AS select `c`.`kd_unsur` AS `kd_unsur`,`c`.`name` AS `nama_unsur`,`b`.`kd_sub_unsur` AS `kd_sub_unsur`,`b`.`id` AS `id_sub_unsur`,`b`.`name` AS `nama_sub_unsur`,`a`.`id` AS `id`,`a`.`p_id` AS `p_id`,`a`.`pertanyaan` AS `pertanyaan` from ((`ref_unsur` `c` join `ref_sub_unsur` `b` on((`b`.`kd_unsur` = `c`.`kd_unsur`))) join `ref_survai_awal` `a` on((`a`.`sub_unsur_id` = `b`.`id`))) order by `a`.`id` */;

/*View structure for view rekapitulasi_survai_awal */

/*!50001 DROP TABLE IF EXISTS `rekapitulasi_survai_awal` */;
/*!50001 DROP VIEW IF EXISTS `rekapitulasi_survai_awal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `rekapitulasi_survai_awal` AS (select `c`.`id` AS `id`,`c`.`name` AS `name`,`b`.`p_id` AS `p_id`,`b`.`pertanyaan` AS `pertanyaan`,`a`.`responden_id` AS `responden_id`,`a`.`jawaban` AS `jawaban` from ((`kuisioner_awal` `a` join `ref_survai_awal` `b` on((`a`.`survai_awal_id` = `b`.`id`))) join `ref_sub_unsur` `c` on((`b`.`sub_unsur_id` = `c`.`id`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
