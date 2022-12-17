-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 10:22 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aplikasikoperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `berkas` varchar(128) NOT NULL,
  `tanggal` date NOT NULL,
  `tag` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `tulis_artikel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `berkas`, `tanggal`, `tag`, `author`, `tulis_artikel`) VALUES
(1, 'Pendapatan Koperasi Syariah Bundo Saiyo Padang Saat Pandemi Covid-19', '4af023b34c0236fe2c8481419f381ad6.png', '2020-12-27', 'Berita Koperasi', 'Admin', '<p>Diketahui&nbsp; sudah hampir 8 bulan pandemi covid-19 melanda Indonesia, namun antusias anggota koperasi syariah Bundo Saiyo Padang untuk melakukan simpanan wajib meningkat. Hal ini diketahui karena koperasi selalu menjaga kepercayaan anggota dan tepat dalam memberikan pinjaman modal usaha maupun kebutuhan sehari-hari.&nbsp;</p>\r\n\r\n<p>Karena meningkatnya jumlah simpanan dan infaq dari anggota, pendapatan koperasi diperkirakan akan mengalami peningkatan pesat. Pengelola koperasi mengatakan selama pandemi covid-19 pendapatan koperasi sempat melemah, dikarenakan banyak anggota mengeluhkan kurangnya pendapatan mereka, namun dengan semangat gotong royong kekeluargaan, kini diketahui dapat saling membantu sesama anggota yang terdampak covid-19.&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(11) NOT NULL,
  `name_foto` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(30) NOT NULL,
  `tag` varchar(30) NOT NULL,
  `berkas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `name_foto`, `tanggal`, `author`, `tag`, `berkas`) VALUES
(1, 'Gallery', '2021-02-24', 'admin 1', 'Koperasi', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_angsuran`
--

CREATE TABLE `tb_angsuran` (
  `id_angsuran` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `angsuran_ke` int(11) NOT NULL,
  `jumlah_angsuran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `sisa_pinjam` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_angsuran`
--

INSERT INTO `tb_angsuran` (`id_angsuran`, `id_pinjaman`, `id_transaksi`, `id`, `name`, `angsuran_ke`, `jumlah_angsuran`, `tanggal`, `sisa_pinjam`) VALUES
(1, 1, 6, 3, 'Ildawirlis', 1, 50000, '2021-03-24', 350000);

--
-- Triggers `tb_angsuran`
--
DELIMITER $$
CREATE TRIGGER `angsuran_kurang` BEFORE INSERT ON `tb_angsuran` FOR EACH ROW BEGIN
UPDATE tb_pinjaman SET nominal = nominal-NEW.jumlah_angsuran
WHERE id_pinjaman = NEW.id_pinjaman;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bagi_hasil`
--

CREATE TABLE `tb_bagi_hasil` (
  `id_bhu` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bagi_hasil`
--

INSERT INTO `tb_bagi_hasil` (`id_bhu`, `id_transaksi`, `id`, `name`, `nominal`, `tanggal`) VALUES
(1, 12, 3, 'Ildawirlis', 1000, '2021-03-29'),
(3, 29, 4, 'Azrienom', 1000, '2021-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `tb_infaq`
--

CREATE TABLE `tb_infaq` (
  `id_infaq` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_infaq`
--

INSERT INTO `tb_infaq` (`id_infaq`, `id_transaksi`, `id`, `name`, `tanggal`, `nominal`) VALUES
(2, 7, 3, 'Ildawirlis', '2021-03-24', 12000),
(3, 8, 3, 'Ildawirlis', '2021-04-03', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pinjaman`
--

CREATE TABLE `tb_pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `jenis_transaksi` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `lama_pinjam` varchar(20) NOT NULL,
  `nominal` int(11) NOT NULL,
  `sisa_pinjam` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pinjaman`
--

INSERT INTO `tb_pinjaman` (`id_pinjaman`, `id_transaksi`, `id`, `name`, `jenis_transaksi`, `tanggal`, `lama_pinjam`, `nominal`, `sisa_pinjam`, `status`) VALUES
(1, 5, 3, 'Ildawirlis', 'Pinjaman', '2021-03-20', '7 Hari', 150000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_simpanan`
--

CREATE TABLE `tb_simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_transaksi` varchar(30) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_simpanan`
--

INSERT INTO `tb_simpanan` (`id_simpanan`, `id_transaksi`, `id`, `name`, `tanggal`, `jenis_transaksi`, `nominal`) VALUES
(1, 1, 3, 'Ildawirlis', '2021-03-29', 'Simpanan Pokok', 100000),
(2, 2, 3, 'Ildawirlis', '2021-03-28', 'Simpanan Wajib', 10000),
(3, 4, 4, 'Azrienom', '2021-02-19', 'Simpanan Pokok', 100000),
(4, 9, 3, 'Ildawirlis', '2021-04-03', 'Simpanan Wajib', 10000),
(5, 10, 5, 'Devita', '2021-03-28', 'Simpanan Pokok', 100000),
(6, 11, 5, 'Devita', '2021-03-28', 'Simpanan Wajib', 10000),
(8, 14, 6, 'Yuliani', '2021-01-20', 'Simpanan Pokok', 100000),
(9, 15, 7, 'Hilda', '2021-02-20', 'Simpanan Pokok', 100000),
(10, 16, 8, 'Elvita', '2021-03-21', 'Simpanan Pokok', 100000),
(11, 17, 9, 'Tisnawati', '2021-03-24', 'Simpanan Pokok', 100000),
(12, 18, 10, 'Asmaniar', '2020-05-10', 'Simpanan Pokok', 100000),
(13, 19, 11, 'Ririn S', '2020-06-12', 'Simpanan Pokok', 100000),
(14, 20, 12, 'Dewi Falmida', '2020-06-12', 'Simpanan Pokok', 100000),
(15, 21, 13, 'Adrizal', '2020-07-07', 'Simpanan Pokok', 100000),
(16, 22, 14, 'Rudi Abbas', '2020-07-22', 'Simpanan Pokok', 100000),
(17, 23, 15, 'Nova', '2020-08-08', 'Simpanan Pokok', 100000),
(18, 24, 16, 'Riki Jumadi', '2020-09-20', 'Simpanan Pokok', 100000),
(19, 25, 17, 'Ernawati', '2020-10-10', 'Simpanan Pokok', 100000),
(20, 26, 18, 'Yurnalis', '2020-11-12', 'Simpanan Pokok', 100000),
(21, 27, 19, 'Indra Yeni', '2020-12-20', 'Simpanan Pokok', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `jenis_transaksi` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `validasi` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id`, `jenis_transaksi`, `tanggal`, `validasi`) VALUES
(1, 3, 'Simpanan Pokok', '2021-03-29', 1),
(2, 3, 'Simpanan Wajib', '2021-03-28', 1),
(4, 4, 'Simpanan Pokok', '2021-02-19', 1),
(5, 3, 'Pinjaman', '2021-03-20', 1),
(6, 3, 'Angsuran', '2021-03-24', 1),
(7, 3, 'Infaq', '2021-03-24', 1),
(8, 3, 'Infaq', '2021-04-03', 1),
(9, 3, 'Simpanan Wajib', '2021-04-03', 1),
(10, 5, 'Simpanan Pokok', '2021-03-28', 1),
(11, 5, 'Simpanan Wajib', '2021-03-28', 1),
(12, 3, 'Bagi Hasil Usaha', '2021-03-29', 1),
(14, 6, 'Simpanan Pokok', '2021-01-20', 1),
(15, 7, 'Simpanan Pokok', '2021-02-20', 1),
(16, 8, 'Simpanan Pokok', '2021-03-21', 1),
(17, 9, 'Simpanan Pokok', '2021-03-24', 1),
(18, 10, 'Simpanan Pokok', '2020-05-10', 1),
(19, 11, 'Simpanan Pokok', '2020-06-12', 1),
(20, 12, 'Simpanan Pokok', '2020-06-12', 1),
(21, 13, 'Simpanan Pokok', '2020-07-07', 1),
(22, 14, 'Simpanan Pokok', '2020-07-22', 1),
(23, 15, 'Simpanan Pokok', '2020-08-08', 1),
(24, 16, 'Simpanan Pokok', '2020-09-20', 1),
(25, 17, 'Simpanan Pokok', '2020-10-10', 1),
(26, 18, 'Simpanan Pokok', '2020-11-12', 1),
(27, 19, 'Simpanan Pokok', '2020-12-20', 1),
(29, 4, 'Bagi Hasil Usaha', '2021-03-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id_berkas` int(11) NOT NULL,
  `name_berkas` varchar(30) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `tanggal` date NOT NULL,
  `berkas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id_berkas`, `name_berkas`, `keterangan`, `tanggal`, `berkas`) VALUES
(1, 'Data Anggota Koperasi', '<p>Laporan Data Anggota Koperasi Syariah Bundo Saiyo Padang</p>\r\n', '2021-03-18', '896923dfc1649551094a8f06dcd27c6e.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `nik`, `tgl_lahir`, `no_hp`, `alamat`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin Koperasi', 'koperasi.bundosaiyo@gmail.com', '', '0000-00-00', '081363455700', 'Jalan Simpang SMA 13 Tanjung Aur\r\nKel. Balai Gadang Kec. Koto Tangah Kota Padang, Sumatera Barat, Indonesia\r\n', 'logo_kop2.gif', '$2y$10$ZCFtoIDLQtEWdWgIW3HSNuj4mOAG5W/LqL8AzFmwBa/m1wFD0cd86', 1, 1, 1609154164),
(2, 'Nofyelni', 'nofyelni@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$yNpS74hERk4SpAn3fK2W1u86nPuHrpQZL5c.IyqnXq9daJ1hwO1Pe', 3, 1, 1609276441),
(3, 'Ildawirlis', 'ildawirlis@gmail.com', '1371115407710002', '0000-00-00', '081370637786', 'Jl. Simpang SMA 13 Balai Gadang\r\n', 'default.jpg', '$2y$10$jMP8ISmcOoV2M8mI3WKGJ.gmAHzKSfiwLOePzA0Rxdk56VkDya/76', 2, 1, 1615186840),
(4, 'Azrienom', 'azrienom@gmail.com', '1371111603710003', '0000-00-00', '081378240491', 'Jl. Hidayah, Balai Gadang, Koto Tangah', 'default.jpg', '$2y$10$a5k44m3OQRpXxox1xMpWD.ZWbDU9bzjEK6kEgadWOqO7WLnUVzqTS', 2, 1, 1615186936),
(5, 'Devita', 'devita@gmail.com', '1371115210790006', '0000-00-00', '081263287789', 'Jl. Ekora No. 45 Balai Gadang, Koto Tangah', 'default.jpg', '$2y$10$IQOoST7akE9Y8mZtgaGASedxDt1XMXDL..EX7zf13TyeYNFx0USvC', 2, 1, 1615187051),
(6, 'Yuliani', 'yuliani@gmail.com', '1371116205810004', '0000-00-00', '085263704489', 'Jl. Empat Lima, No. 237, Balai Gadang, Koto Tangah', 'default.jpg', '$2y$10$p8UTPwNQVfRPrkdVtt96ZOS0noTbAfHRJtwjBxLsbVafG.gx6J8WG', 2, 1, 1615187485),
(7, 'Hilda', 'hilda@gmail.com', '1371114107880001', '0000-00-00', '085363749965', 'Balai Gadang', 'default.jpg', '$2y$10$oQnKsX367OCSgvqXEJ5x6ea5Yq7P49Gy6UKw9.8GEZF7RSRt.LbFK', 2, 1, 1615187625),
(8, 'Elvita', 'elvita@gmail.com', '1371115412730002', '0000-00-00', '083178669088', 'Jl. Hidayah, Balai Gadang, Kec. Koto Tangah, Padang', 'default.jpg', '$2y$10$2H7rWE3lIbtR04y1Cl3ale1Ncb8VDPFC7/mMQA22PQzuiULA5FOYS', 2, 1, 1615187738),
(9, 'Tisnawati', 'tisnawati@gmail.com', '1371046603670001', '0000-00-00', '', 'Jl. Bypass SMA Liga Dakwah, Koto Tangah, Padang', 'default.jpg', '$2y$10$hiCnDFzSDBumsFgsMIFRGOJSQQ/8m90UXCqmo/6D0zRag7K.vhMmy', 2, 1, 1615187838),
(10, 'Asmaniar', 'asmaniar@gmail.com', '1371116808560002', '0000-00-00', '', 'Balai Gadang', 'default.jpg', '$2y$10$UD5IeOPfyamPuMr8QhIKduTETimUtoltZTvPNJNWtV.CMiiTINWqG', 2, 1, 1615187986),
(11, 'Ririn S', 'ririn@gmail.com', '1302105704920001', '0000-00-00', '085263706494', 'Jl. Ekora Balai Gadang, Kec. Koto Tangah', 'default.jpg', '$2y$10$GZmUuwJdcliL8KkRR7jdcO90L/rwmBqf79ajXLqZ4yOel/C/L9wPy', 2, 1, 1615188087),
(12, 'Dewi Falmida', 'dewi@gmail.com', '1371117101680002', '0000-00-00', '081261034764', 'Jl. Ekora Balai Gadang, Kec. Koto Tangah', 'default.jpg', '$2y$10$XrKFPPXs82qvEnDrCy3WWu5SSuw1k96bsoTZoSyz7fKiuyDMwUV0y', 2, 1, 1615188209),
(13, 'Adrizal', 'adrizal@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$oKm4SFMaUxJ8OeAI2nDZTe7vubVlV2ku.HMJXrSFVPmpO2FEScasC', 2, 1, 1615188453),
(14, 'Rudi Abbas', 'rudiabbas@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$oXklFdtL/RMNUAbR9L0OLuWE36y0lihNY8c6nwKKd6miSumDTQuAS', 2, 1, 1615188665),
(15, 'Nova', 'nova@gmail.com', '', '0000-00-00', '', '\r\n', 'default.jpg', '$2y$10$OxwRRgl8bsGdwdPwSmduROfmF8g3gy8AI9gSCnPlXmfJFcJcGZqza', 2, 1, 1615193521),
(16, 'Riki Jumadi', 'riki@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$0SJKdgv/kh9Ou8P38mK7BOkL4gl87FXFpc4S/YDfNhugP/EW520WW', 2, 1, 1615193618),
(17, 'Ernawati', 'ernawati@gmail.com', '', '0000-00-00', '', '\r\n', 'default.jpg', '$2y$10$0dye5iDO1BG9DIdLvcgdMumej7sCBWvWKkxXv/LrnCD0hOsrus5e.', 2, 1, 1615193769),
(18, 'Yurnalis', 'yurnalis@gmail.com', '', '0000-00-00', '', '\r\n', 'default.jpg', '$2y$10$zgRGz1Zm3hQbTzuhb/MhU.VNeEH1NRtjzseO6SLaFZn6BXZ4HoxLe', 2, 1, 1615193945),
(19, 'Indra Yeni', 'indra@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$zFkSbvIDNPLT8kdGT6m4oOtcMCTpdzOUTcItSiPJcRG.dT4oF58tC', 2, 1, 1615194043),
(20, 'Tati', 'tati@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$WH65BIYPzmDRGM/sHv5LveE7bFTFfxrYZg2CqsjwZkQxJZYGLtFQy', 2, 1, 1615494928),
(21, 'Dewi Danih', 'dewidanih@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$NuNsgMPss81JA.TgREZpdukMwRv8RvjbvmtjZmbf0b9waX5boDy0S', 2, 1, 1615495090),
(22, 'Murniati', 'murniati@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$XfPaGqBoJouCmJfAe1UpA.WU50pSlRknK6nrFvMebrKqD4zrdvJbm', 2, 1, 1615495223),
(23, 'Yolla', 'yolla@gmail.com', '', '0000-00-00', '', '\r\n', 'default.jpg', '$2y$10$qaRxu1k2DQUCEYArE6/5nOMpeWu8agKhA9qFk6tkyo3rQzjSn127W', 2, 1, 1615495372),
(24, 'Lastri', 'lastri@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$4Y2uTChlXsulHBl3TpUvn.aOrggjHGJE511RgleVuCxZ2rGALNUMy', 2, 1, 1615495497),
(25, 'Yelvi', 'yelvi@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$m8Ws2R2QqaguNklEaEFDhO7A2UVr5X9gip0P8pRW4U9G8qulOQNPC', 2, 1, 1615495602),
(26, 'Eti Lauk', 'eti@gmail.com', '', '1962-10-23', '', '', 'default.jpg', '$2y$10$W5cYAtyiFv/1UQR4LLMNE.oBazO..GfBFP5XeYgXAem92Q7yP4vMK', 2, 1, 1615495743),
(27, 'Ali Akbar', 'aliakbar@gmail.com', '', '1979-05-03', '', '', 'default.jpg', '$2y$10$4vHJq4BVjlNW5z3EZ9yulejgeEXi0NvczdeqM/S8vg1gX35JU0bvK', 2, 1, 1615495814),
(28, 'Siregar', 'siregar@gmail.com', '', '1965-09-16', '', '', 'default.jpg', '$2y$10$wZ0BFCw34SgTKshMpqIJNuQ4pnibTJWOHwd39ZG9Ys1MrFP/KTTOa', 2, 1, 1615495948),
(29, 'Hendri', 'hendri@gmail.com', '', '1968-07-29', '', '', 'default.jpg', '$2y$10$7VUclLISa.Bhj.z4s6l.t.zVH3.gZLWRftIl3bNVQcWKkoOsONkv2', 2, 1, 1615829540),
(30, 'Fitri Ningsih', 'fitriningsih@gmail.com', '', '1976-12-20', '', '', 'default.jpg', '$2y$10$Tn1DcgdX3yDlF0yJ3pFY/uZNk7RcivYjgm/GT4gGoPLIfm0KZz8ka', 2, 1, 1615829716),
(31, 'Widya', 'widya@gmail.com', '', '1989-02-26', '', '', 'default.jpg', '$2y$10$XVtowSqC5EMhAoIZY9.BIOnxNDohp4Czl94cc0XsvZMKtkWJpgmBa', 2, 1, 1615829806),
(32, 'Des Kue', 'des@gmail.com', '', '1981-11-27', '', '', 'default.jpg', '$2y$10$p7LXsz7KFpi9IkH7y/XXbu08Xjuh3pc1OTdfRpTDCgxWR1G/jpoRO', 2, 1, 1615829881),
(33, 'Cici Ikan', 'cici@gmail.com', '', '1964-12-10', '', '', 'default.jpg', '$2y$10$rhY2s0LMmLcvyN5ZAjhUyO95TstOrecmG2SipKI9AIGAnQesCdM1S', 2, 1, 1615829944),
(34, 'Id Ikan', 'id@gmail.com', '', '1962-02-19', '', '', 'default.jpg', '$2y$10$M1NJzoVNgovtRg.TyLCbXOHRwPn0kikA8rPFu1zY4thfLrxANaor2', 2, 1, 1615830081),
(35, 'Ratna', 'ratna@gmail.com', '', '1972-05-20', '', '', 'default.jpg', '$2y$10$aeUmeCPqaIiFwkMk4QREP.SSKQhmel6.sPUPcBDNwhFgVcJjnYF.W', 2, 1, 1615830150),
(36, 'Derit Buah', 'derit@gmail.com', '', '1978-07-04', '', '', 'default.jpg', '$2y$10$iE3OSNKzM25Ua.X76.AVNep/SZX1NbMMmHxgnoxCN34fABih6NCbK', 2, 1, 1615830341),
(37, 'Ef RT', 'ef@gmail.com', '', '1968-01-21', '', '', 'default.jpg', '$2y$10$MMCySWAZKipi0DStkwlyQOcny9p1.xRY9RKvz8N.C1kK8fe3NImke', 2, 1, 1615830437),
(38, 'Opet', 'opet@gmail.com', '', '1976-09-17', '', '', 'default.jpg', '$2y$10$B04fyRpuA2JkAk9K07h8zeCXqHp/cEBm73596s4WSocl6rrL05AWC', 2, 1, 1615830507),
(39, 'Ida Dodoy', 'idadodoy@gmail.com', '', '1973-03-31', '', '', 'default.jpg', '$2y$10$P4oe1pkXtWxG65/n/XrkwO65QTA7KjOsKBvG/9b3jziwCLLH/4pQK', 2, 1, 1615830652),
(40, 'Des Bedong', 'desbedong@gmail.com', '', '1967-07-04', '', '', 'default.jpg', '$2y$10$kVVA1pSc86DV9r08nrw82eK9kp5H.m2VzkDh7ImYq.okfxe2LVE5u', 2, 1, 1615830815),
(41, 'Lia Mori', 'liamori@gmail.com', '', '1985-10-20', '', '', 'default.jpg', '$2y$10$Ma9qaplrZahTpEAsjlSUDejmQMPZcHG219HSGgivG/3JknGKpEloK', 2, 1, 1615830885),
(42, 'Uni Eva', 'eva@gmail.com', '', '1963-05-29', '', '', 'default.jpg', '$2y$10$p2y1v5JhVQhwj2RqlN7lo.HTX54i4Ceu/aEqM3e/TWnTvCNvHDDiS', 2, 1, 1615830989),
(43, 'Ida Yakup', 'idayakup@gmail.com', '', '1969-08-05', '', '', 'default.jpg', '$2y$10$RbUUW7TlckhvO0N/25I05.rDFBRzatv2vfT1kmoomqOWCkxJO/DNu', 2, 1, 1615832597),
(44, 'Santi', 'santi@gmail.com', '', '1979-11-18', '', '', 'default.jpg', '$2y$10$RaFinbqKph1Hje.FVB4tUOIUw0clKwUxVxb3klV7P2xrh6jgULaLm', 2, 1, 1615835890),
(45, 'Ed Nasi G', 'ed@gmail.com', '', '1968-12-07', '', '', 'default.jpg', '$2y$10$E5zJPU5rEifw317cnoA2tO22QCo/1H2DaLwdfHh9e/gwpeL9mXY1e', 2, 1, 1615836042),
(46, 'Yes Rakik', 'yesrakik@gmail.com', '', '1967-06-11', '', '', 'default.jpg', '$2y$10$xBsSTc6tqcBOSaM6g/64GeMs88m2Pq3bMJgBASK8bslu7UhpDbmla', 2, 1, 1615836126),
(47, 'Dila David', 'diladavid@gmail.com', '', '1974-12-09', '', '', 'default.jpg', '$2y$10$iobsXOyvbfgiW8Bc4iFUAeCWMoT0SyZCdAIzuNrGznQywQmhhhvbK', 2, 1, 1615836240),
(48, 'Eli Ikan', 'eli@gmail.com', '', '1967-11-18', '', '', 'default.jpg', '$2y$10$XsLMMBY/yTMyTr6VUTZXzufAN/aYZU0dxzWCLCPk.RvjKbrM5e6Da', 2, 1, 1615836338),
(49, 'Yul Lokan', 'yul@gmail.com', '', '1973-02-21', '', '', 'default.jpg', '$2y$10$wbGYJ1.KH24lICfp2rf//euQc3eMxqyCk7AYJoVTGDOIm1/7QEaGu', 2, 1, 1615836478),
(50, 'Eni Karonek', 'enikaronek@gmail.com', '', '1969-11-08', '', '', 'default.jpg', '$2y$10$z5tcq/Wh3ktQK7SGAyJ4xO9kmjAckc0EJoLwcr.iZTW6RUptbwLvy', 2, 1, 1615836593),
(51, 'Ipel', 'ipel@gmail.com', '', '1980-09-27', '', '', 'default.jpg', '$2y$10$Sdl3Dx3O2bJRy.Q/Vwp8ouU0HCygZ7/6K8f7TVywgDHWiSnZGwcqu', 2, 1, 1615836688),
(52, 'Siska', 'siska@gmail.com', '', '1985-01-02', '', '', 'default.jpg', '$2y$10$BswldGyqz8BLjTldoYo7c.U1Ywb7.voKCaEqOZLq0YhIoYsOpwxVq', 2, 1, 1615836760),
(53, 'Edwar', 'edwar@gmail.com', '', '1982-04-26', '', '', 'default.jpg', '$2y$10$bTSfcCwxWz5lCym/pBFW2.y2PlBTgkKw8LOiUquPdPqBKueU7izdm', 2, 1, 1615836879),
(54, 'Mimi', 'mimi@gmail.com', '', '1991-07-31', '', '', 'default.jpg', '$2y$10$aPI91QBwX9a1qC9kRFboh.NF785p9vhPFH0uQxB0kVtZZxQYyCPOe', 2, 1, 1615836953),
(55, 'Desi Yen', 'desiyen@gmail.com', '', '1969-08-13', '', '', 'default.jpg', '$2y$10$fQ2UWSRqb6yYAVQW1kOSNOPjj6sgxxpIU67BHX37T657yKEj4oF3u', 2, 1, 1615837152),
(56, 'Eri Lemek', 'erilemek@gmail.com', '', '1976-04-27', '', '', 'default.jpg', '$2y$10$d4Tb.GCa9pwlzIrE/j/OQuUquaIsiW0PBnCgyWpso.YypuxWr/yZ.', 2, 1, 1615837249),
(57, 'Desmarita', 'desmarita@gmail.com', '', '1981-06-02', '', '', 'default.jpg', '$2y$10$SgFPMjecamKQ1w.CZv1gjOa/VLk5hU/JWtcLsq9C4xj0fpO/LW7lm', 2, 1, 1615837834),
(58, 'Rini', 'rini@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$AOnJE4mOgSnkHUBEkka6v.7Z5zUw8MotD/CMN66UXuN1eLaU17pGK', 2, 1, 1617006954),
(59, 'Asmadona', 'asmadona@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$ONjx/wfjaBEyuuj8P0f4w.OxnnlmT9F3KE5tvFRm4Tf4u7YEdVkKq', 2, 1, 1617006991),
(60, 'Putri', 'putri@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$hlT.8GnuxoY8E3MtTwhp1Ouu24jhLo5iM3GzJtGHSm6JApJ1qOPKq', 2, 1, 1617007035),
(61, 'Azmira', 'azmira@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$8LOUlbenAHbVk2x3X0Wm1OEV66u30JnhtWWyyKSEHq7LxmXvuMJDu', 2, 1, 1617007126),
(62, 'Nurhayyati', 'nurhayyati@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$E/l1SVOBcu3g/IVZOX8NXuGfo/POH7zF7s3wNfPrEN.s0qbbaFtjO', 2, 1, 1617007165),
(63, 'Marni', 'marni@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$TgxYwK9MFesxmgVaFgesAe0ldjHCB2jMySNMzXaaBPOgE1dk0hcoe', 2, 1, 1617007196),
(64, 'Asniati', 'asniati@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$OjaZeeJk68IBDpICXwHCqe45okIIQ4Lbecm87Jt6sbzDEWbmSYkwy', 2, 1, 1617007249),
(65, 'Murlinda', 'murlinda@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$zXkAtHnh/laJAJ5Rr4UJMe8B/zU3vizfmghjeagny./ShcrjvOKui', 2, 1, 1617007288),
(66, 'Fitra', 'fitra@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$W.w02b504q7RX0PksKFXe.0fse1MNSkdMqC1eu6vfEjjBftzx6GDm', 2, 1, 1617007334),
(67, 'Yessi Imun', 'yessiimun@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$aB9kaEwjRoEZg9nLvI8T0OA.VtU7zfywfBKVVoiKLjjTV0KJn3yJ2', 2, 1, 1617007382),
(68, 'Lili One Dah', 'lili@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$hx54GrMYjH/s1cBDjFOh1.7inv0hyw.N.QZdX1rcpp7o/n/Qe611.', 2, 1, 1617007420),
(69, 'Vio Ilih', 'vioilih@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$pjZ0qYAwfeQMwiMRvDIrZejQBQ9ARkpJk3M21gTxBOkqAYZYdT6X6', 2, 1, 1617007453),
(70, 'Asriana', 'asriana@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$FBiZhGLbHh/aWJfC6.7aoOsmxqpCakUvrrzTfmGs./5r57CCiOBzK', 2, 1, 1617007495),
(71, 'Dewi Hatari', 'dewihatari@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$Er82NATqDByF/.cp5FxilebsV.ftaqi1LZODf8CcxCgf4g2HcGQFq', 2, 1, 1617007540),
(72, 'Marliza', 'marliza@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$xqT78uK7cPdrhQm.ux7sUuMX82tLE2AVIo7dyQQBg8JnbEPGYfGR2', 2, 1, 1617007579),
(73, 'Des Lado', 'deslado@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$41EEVPiVY29qYIdxIXeATeWfsk6Rz4KimaHRaHRp4S9gv2wevLKBu', 2, 1, 1617007632),
(74, 'Eni', 'eni@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$k5kiTffxa6hXgZZN56fbwOraj6QSPztfBHqu4QBgsMF31VeEzUAeC', 2, 1, 1617007669),
(75, 'Lin Sayu', 'linsayu@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$jnuRMtVQR53uSvn06YWe6.dL1g0h3YhyrXQSQNaXjjnwHsLqJ3NJ.', 2, 1, 1617007707),
(76, 'Imit Sayu', 'imitsayu@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$Yf4buR0GxYJmYADvtjTFI.VzDlI5OA5Lsq99v6s9DsZ7R1yoNBNee', 2, 1, 1617007748),
(77, 'Uni Enen', 'unienen@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$27B5MN7NVaXqr9Bd6rpf0OlfxIINMmWpXGflOnvn6QKlbgzrgHHDC', 2, 1, 1617007791),
(78, 'Upik Abang', 'upikabang@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$aTzQ.vvIYwEHtft0ze3VgunQ9XafuDC7MwYkshX9Tg1qYYhEqaSIa', 2, 1, 1617007831),
(79, 'Anis', 'anis@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$SQ0dRU4.M28zdeTavDA.FOtQPGbakfEI3MKUj.f1wU9algZRBJSV6', 2, 1, 1617007858),
(80, 'Onang', 'onang@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$JNm4bT6QDCwGiAQujn/52uk8BHUwkUH2/Dz2ypSBsqx2vXo4LJq2S', 2, 1, 1617007888),
(81, 'Iya Onang', 'iyaonang@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$VSr/9c.DrlvYUdZ2PgTid.W6IVtVzwDl0GN1q6yJ5ffJ7oXcj83g6', 2, 1, 1617007943),
(82, 'An Lado', 'anlado@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$RvMdDwMChU2cYBfpYcOdLOJ40rSXbvK7Q.CVDZ/om4powIpgeHq/W', 2, 1, 1617008021),
(83, 'Yance Don', 'yancedon@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$hLo/OzCZjmy7t7wpVnFnk.tTTp92H6H7D8.bOjmgB.me3MoIlDJyS', 2, 1, 1617008169),
(84, 'Eli Londri', 'elilondri@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$A3LA775YJk2M3Dq/lRDH8ON2/mMPcahE3oPCC9I2bv.uvJ8E9uJLu', 2, 1, 1617008213),
(85, 'Reni Londri', 'renilondri@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$psCqQTNf4QTsA6.U330OueqcFlnfERSJS7BBUZ0K1ot2SNcYCZPDK', 2, 1, 1617008275),
(86, 'Len Sayu', 'lensayu@gmail.com', '', '0000-00-00', '', '', 'default.jpg', '$2y$10$MfpGM1vzOwez1aP1yNcMmekKMAUMflruI06kEsF.P8aQPsZMEBnhu', 2, 1, 1617008312);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2),
(4, 3, 4),
(5, 1, 3),
(6, 1, 4),
(7, 1, 6),
(8, 1, 2),
(9, 2, 5),
(10, 1, 5),
(12, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Transaksi'),
(4, 'Laporan'),
(6, 'Menu'),
(7, 'User Transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Anggota'),
(3, 'Pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashbord', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Profil', 'user/profil', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profil', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 2, 'Ganti Password', 'user/changepassword', 'fas fa-fw fa-lock', 1),
(5, 3, 'Daftar Pengajuan Transaksi', 'transaksi', 'fas fa-fw fa-university', 1),
(6, 3, 'Data Simpanan Anggota', 'transaksi/simpan', 'fas fa-fw fa-wallet', 1),
(8, 6, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(9, 6, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-bars', 1),
(10, 1, 'Role', 'admin/role', 'fas fa-fw fa-users-cog', 1),
(11, 4, 'Cetak Laporan', 'laporan', 'fas fa-fw fa-file', 1),
(12, 3, 'Data Pinjaman Anggota', 'transaksi/pinjam', 'fas fa-fw fa-search-dollar', 1),
(13, 3, 'Data Angsuran Anggota', 'transaksi/angsuran', 'fas fa-fw fa-file-invoice-dollar', 1),
(14, 3, 'Data Infaq Anggota', 'transaksi/infaq', 'fas fa-fw fa-coins', 1),
(15, 6, 'Gallery Management', 'menu/gallery', 'fas fa-fw fa-image', 1),
(16, 6, 'Berita Management', 'menu/berita', 'fas fa-fw fa-newspaper', 1),
(23, 3, 'Bagi Hasil Usaha', 'transaksi/bagihasil', 'fas fa-fw fa-folder', 1),
(24, 7, 'Pengajuan Transaksi', 'anggota_transaksi', 'fas fa-fw fa-folder', 1),
(25, 7, 'Buku Simpanan', 'anggota_transaksi/buku_simpanan', 'fas fa-fw fa-book', 1),
(26, 7, 'Buku Pinjaman', 'anggota_transaksi/buku_pinjaman', 'fas fa-fw fa-book', 1),
(27, 7, 'Buku Angsuran', 'anggota_transaksi/buku_angsuran', 'fas fa-fw fa-book', 1),
(28, 7, 'Buku Infaq', 'anggota_transaksi/buku_infaq', 'fas fa-fw fa-book', 1),
(29, 1, 'Data Anggota', 'admin/data_anggota', 'fas fa-fw fa-users', 1),
(31, 7, 'Rincian Transaksi Terakhir', 'anggota_transaksi/rincian', 'fas fa-fw fa-book', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `tb_angsuran`
--
ALTER TABLE `tb_angsuran`
  ADD UNIQUE KEY `id_angsuran` (`id_angsuran`);

--
-- Indexes for table `tb_bagi_hasil`
--
ALTER TABLE `tb_bagi_hasil`
  ADD UNIQUE KEY `id_bhu` (`id_bhu`);

--
-- Indexes for table `tb_infaq`
--
ALTER TABLE `tb_infaq`
  ADD UNIQUE KEY `id_infaq` (`id_infaq`);

--
-- Indexes for table `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  ADD UNIQUE KEY `id_pinjaman` (`id_pinjaman`);

--
-- Indexes for table `tb_simpanan`
--
ALTER TABLE `tb_simpanan`
  ADD UNIQUE KEY `id_simpanan` (`id_simpanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_angsuran`
--
ALTER TABLE `tb_angsuran`
  MODIFY `id_angsuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_bagi_hasil`
--
ALTER TABLE `tb_bagi_hasil`
  MODIFY `id_bhu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_infaq`
--
ALTER TABLE `tb_infaq`
  MODIFY `id_infaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_simpanan`
--
ALTER TABLE `tb_simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
