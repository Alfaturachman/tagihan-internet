/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.0.30 : Database - ci3_diskominfo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ci3_diskominfo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `ci3_diskominfo`;

/*Table structure for table `invoice` */

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_langganan` int NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `tanggal_invoice` date NOT NULL,
  `total_harga` double NOT NULL,
  `status` enum('Dibayar','Belum Bayar') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_langganan` (`id_langganan`),
  CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`id_langganan`) REFERENCES `langganan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `invoice` */

insert  into `invoice`(`id`,`id_langganan`,`invoice`,`tanggal_invoice`,`total_harga`,`status`) values 
(1,3,'INV-677D64D7072C8','2025-01-07',450000,'Belum Bayar');

/*Table structure for table `langganan` */

DROP TABLE IF EXISTS `langganan`;

CREATE TABLE `langganan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_paket_layanan` int NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_berakhir` datetime NOT NULL,
  `status` enum('Aktif','Tidak Aktif','Ditangguhkan') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_paket_layanan` (`id_paket_layanan`),
  CONSTRAINT `langganan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `langganan_ibfk_2` FOREIGN KEY (`id_paket_layanan`) REFERENCES `paket_layanan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `langganan` */

insert  into `langganan`(`id`,`id_user`,`id_paket_layanan`,`tanggal_mulai`,`tanggal_berakhir`,`status`) values 
(1,2,2,'2025-01-07 23:50:39','2025-02-07 01:03:58','Aktif'),
(3,7,3,'2025-01-08 00:00:00','2025-02-08 00:00:00','Aktif');

/*Table structure for table `paket_layanan` */

DROP TABLE IF EXISTS `paket_layanan`;

CREATE TABLE `paket_layanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_paket` enum('35 mbps','50 mbps','100 mbps') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_paket` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `paket_layanan` */

insert  into `paket_layanan`(`id`,`nama_paket`,`harga_paket`) values 
(1,'35 mbps',250000),
(2,'50 mbps',350000),
(3,'100 mbps',450000);

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_invoice` int NOT NULL,
  `total_bayar` double NOT NULL,
  `tanggal_bayar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `upload_bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_invoice` (`id_invoice`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_invoice`) REFERENCES `invoice` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `pembayaran` */

/*Table structure for table `pengaduan` */

DROP TABLE IF EXISTS `pengaduan`;

CREATE TABLE `pengaduan` (
  `id` int NOT NULL,
  `instansi_id` int NOT NULL,
  `tgl_pengaduan` date NOT NULL,
  `judul_pengaduan` varchar(255) NOT NULL,
  `paket_layanan` enum('35 mbps','50 mbps','100 mbps') DEFAULT NULL,
  `jumlah_tagihan` double DEFAULT NULL,
  `isi_pengaduan` text NOT NULL,
  `alamat` text,
  `keterangan` text,
  `status_pengaduan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengaduan` */

insert  into `pengaduan`(`id`,`instansi_id`,`tgl_pengaduan`,`judul_pengaduan`,`paket_layanan`,`jumlah_tagihan`,`isi_pengaduan`,`alamat`,`keterangan`,`status_pengaduan`) values 
(4,2,'2025-01-08','ubah pengaduan','100 mbps',300000,'tes ubah','majapahit','halooooo',2),
(5,2,'2025-01-08','asdasd','100 mbps',300000,'tess','majapahit','halooooo',0),
(9,2,'2025-01-08','Coba tambah data pengaduan','100 mbps',300000,'berikut adalah isi dari pengaduan instansi saya, tolong di proses secepatnya. Terima kasih\r\n','majapahit','halooooo',1),
(10,2,'2021-01-23','tes notif','100 mbps',300000,'notif baru uhuy','majapahit','halooooo',0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_instansi` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`nama_instansi`,`email`,`alamat`,`username`,`password`,`role_id`) values 
(1,'Hesty A.','hesty@gmail.com','Majapahit','admin123','$2y$10$i4HD610v2o5HOxZXEC4G5eO.E.D0oVy/eKAohNku2EXZOOW4Y75pC',1),
(2,'Instansi A','instansi.pertama@gmail.com','Lhokseumawe','hesty123','$2y$10$QO4ipamQMvPbBrFZcVD35ODxdUPYOoVYyqmwRbw5EgJhmSxW/3fEm',2),
(6,'Alfaturachman','alfa@gmail.com','jl. poncowolo','alfa','$2y$10$iHe.weSdwKYt7CajgabjsuHdR1kbdwH6RM3RwUiHCZZALFLtmPSuy',1),
(7,'Alfa','fiant@gmail.com','Jl Majapahit No.56','ale','$2y$10$iHe.weSdwKYt7CajgabjsuHdR1kbdwH6RM3RwUiHCZZALFLtmPSuy',2);

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values 
(1,'Admin'),
(2,'User');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
