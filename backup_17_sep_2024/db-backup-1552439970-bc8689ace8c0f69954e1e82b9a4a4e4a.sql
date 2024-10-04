DROP TABLE IF EXISTS usrlogin;

CREATE TABLE `usrlogin` (
  `name` varchar(35) NOT NULL,
  `username` varchar(10) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS waddpoint;

CREATE TABLE `waddpoint` (
  `p_addno` varchar(20) NOT NULL,
  `c_code` varchar(30) NOT NULL,
  `p_code` varchar(20) NOT NULL,
  `p_qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wbuyhead;

CREATE TABLE `wbuyhead` (
  `b_code` varchar(15) NOT NULL,
  `b_refno` varchar(15) NOT NULL,
  `b_date` date NOT NULL,
  `b_dateinput` date NOT NULL,
  `s_code` varchar(15) NOT NULL,
  `u_code` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wbuytail;

CREATE TABLE `wbuytail` (
  `b_code` varchar(15) NOT NULL,
  `g_code` varchar(10) NOT NULL,
  `i_code` varchar(15) NOT NULL,
  `i_name` varchar(30) NOT NULL,
  `i_qty` float NOT NULL,
  `i_cogs` float NOT NULL,
  `i_weight` float NOT NULL,
  `i_imgfile` text NOT NULL,
  `b_sub` float NOT NULL DEFAULT '0',
  `b_grand` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `i_code` (`i_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wcustomers;

CREATE TABLE `wcustomers` (
  `c_code` varchar(15) NOT NULL,
  `c_id` varchar(20) NOT NULL,
  `c_name` text NOT NULL,
  `c_pob` text NOT NULL,
  `c_dob` date NOT NULL,
  `c_addr` text NOT NULL,
  `c_rt` text NOT NULL,
  `c_kel` text NOT NULL,
  `c_kec` text NOT NULL,
  `c_gender` varchar(1) NOT NULL,
  `c_phone` varchar(20) NOT NULL,
  `c_join` date NOT NULL,
  UNIQUE KEY `c_code` (`c_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wgroups;

CREATE TABLE `wgroups` (
  `g_code` varchar(15) NOT NULL,
  `g_name` varchar(30) NOT NULL,
  UNIQUE KEY `g_code` (`g_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO wgroups VALUES("001","GROUP001");



DROP TABLE IF EXISTS winvent;

CREATE TABLE `winvent` (
  `c_code` varchar(15) NOT NULL,
  `c_group` varchar(10) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_cogs` float NOT NULL,
  `c_sales` float NOT NULL,
  `c_status` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS winventory;

CREATE TABLE `winventory` (
  `i_code` varchar(15) NOT NULL,
  `g_code` varchar(15) NOT NULL,
  `i_supp` varchar(10) NOT NULL,
  `i_barcode` varchar(20) NOT NULL,
  `i_name` varchar(60) NOT NULL,
  `i_qty` float NOT NULL,
  `i_qtymin` float NOT NULL,
  `i_unit` varchar(10) NOT NULL,
  `i_size` varchar(20) NOT NULL,
  `i_color` varchar(20) NOT NULL,
  `i_brands` varchar(20) NOT NULL,
  `i_article` text NOT NULL,
  `i_cogs` float NOT NULL,
  `i_kdsell` varchar(10) NOT NULL,
  `i_sell` float NOT NULL,
  `i_status` varchar(1) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `i_code` (`i_code`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO winventory VALUES("001testary","001","","","CRESSIDA DH002 BB M","12","1","PCS","M","BB","CRESSIDA","DH002","30000","PGHB","56000","A","8"),
("001ooo","001","","","HM OBLONG HM PINK L","10","1","PCS","L","PINK","HM","OBLONG HM","70000","PJH","84000","A","9"),
("0013333","001","001DK","7777777","OTTO TOO BG 24 YELLOW XL","13","1","PCS","XL","YELLOW","OTTO","TOO BG 24","45600","PKL","78000","A","10"),
("001","","001DK","101CA0001BB27","CA DD CA 456 BLUE XL","12","1","PCS","XL","BLUE","CA","DD CA 456","45000","PLU","56000","A","11"),
("002","001","001DK","101CR0002L","CRESIDA BA005 BLACK L","20","1","PCS","L","BLACK","CRESIDA","BA005","50000","YXX","135000","A","12");



DROP TABLE IF EXISTS wpoint;

CREATE TABLE `wpoint` (
  `p_code` varchar(25) NOT NULL,
  `p_name` varchar(60) NOT NULL,
  `p_qty` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wredpoint;

CREATE TABLE `wredpoint` (
  `pred_no` varchar(20) NOT NULL,
  `c_code` varchar(20) NOT NULL,
  `pred_qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wsellhead;

CREATE TABLE `wsellhead` (
  `s_code` varchar(25) NOT NULL,
  `s_date` date NOT NULL,
  `s_dateinput` date NOT NULL,
  `c_code` varchar(25) NOT NULL,
  `u_code` varchar(25) NOT NULL,
  `s_premi` float NOT NULL,
  `s_deduct` float NOT NULL,
  UNIQUE KEY `s_code` (`s_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wselltail;

CREATE TABLE `wselltail` (
  `s_code` varchar(25) NOT NULL,
  `g_code` varchar(25) NOT NULL,
  `i_code` varchar(50) NOT NULL,
  `i_name` varchar(50) NOT NULL,
  `i_qty` float NOT NULL,
  `i_cogs` float NOT NULL,
  `i_weight` float NOT NULL,
  `i_imgfile` varchar(50) NOT NULL,
  UNIQUE KEY `s_code` (`s_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




DROP TABLE IF EXISTS wsuppliers;

CREATE TABLE `wsuppliers` (
  `s_code` varchar(15) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `s_contact` varchar(30) NOT NULL,
  `s_addr` int(60) NOT NULL,
  `s_phone` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO wsuppliers VALUES("001DK","DINA KERSANA","TEST","0","09808"),
("DKNY","DINAS KEBERSIHAN NEW YORK","GAGA","0","090909");



DROP TABLE IF EXISTS xloginuser;

CREATE TABLE `xloginuser` (
  `cdtusercode` text NOT NULL,
  `cdtusername` text NOT NULL,
  `cdtuserpwd` text NOT NULL,
  `cdtfullname` text NOT NULL,
  `cdtemail` text NOT NULL,
  `cdtmphone` text NOT NULL,
  `cdtpic` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




