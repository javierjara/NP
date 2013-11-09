<?php
function contactimporter_providers()
{
	$sTable = Phpfox::getT('contactimporter_providers');
	$sql = "CREATE TABLE IF NOT EXISTS `$sTable` (
		`name` varchar(10) NOT NULL,
		`title` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		`logo` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
		`enable` int(2) NOT NULL DEFAULT '1',
		`status` int(2) NOT NULL DEFAULT '1',
		`type` varchar(20) NOT NULL,
		`description` varchar(512) DEFAULT NULL,
		`requirement` varchar(20) DEFAULT NULL,
		`check_url` varchar(100) DEFAULT NULL,
		`version` varchar(20) DEFAULT NULL,
		`base_version` varchar(20) DEFAULT NULL,
		`supported_domain` longtext,
		`order_providers` int(2) NOT NULL DEFAULT '200',
		`default_domain` varchar(20) DEFAULT NULL,
		`photo_import` int(1) NOT NULL DEFAULT '0',
		`photo_enable` int(1) NOT NULL DEFAULT '0',
		`o_type` varchar(20) NOT NULL,
		PRIMARY KEY (`name`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";	
	Phpfox::getLib('phpfox.database')->query($sql);	
	$sql = "INSERT IGNORE INTO `$sTable` (`name`, `title`, `logo`, `enable`, `status`, `type`, `description`, `requirement`, `check_url`, `version`, `base_version`, `supported_domain`, `order_providers`, `default_domain`, `photo_import`, `photo_enable`, `o_type`) VALUES	
		('abv', 'Abv', 'abv', 0, 1, 'email', 'Get the contacts from a Abv account', 'email', 'http://www.abv.bg/', '1.0.6', '1.8.3', 'a:3:{i:0;s:3:\"abv\";i:1;s:8:\"gyuvetch\";i:2;s:3:\"gbg\";}', 200, '', 0, 0, 'email'),
		('aol', 'AOL', 'aol', 1, 1, 'email', 'Get the contacts from an AOL account', 'email', 'http://webmail.aol.com', '1.5.4', '1.9.0', 'a:1:{i:0;s:3:\"aol\";}', 5, 'aol.com', 0, 0, 'email'),
		('apropo', 'Apropo', 'apropo', 0, 1, 'social', 'Get the contacts from a Apropo account', 'user', 'http://amail.apropo.ro/index.php', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('atlas', 'Atlas', 'atlas', 0, 1, 'social', 'Get the contacts from a Atlas account', 'user', 'http://www.atlas.cz/', '1.0.4 ', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('aussiemail', 'Aussiemail', 'aussiemail', 0, 1, 'social', 'Get the contacts from a Aussiemail account', 'user', 'http://freemail.aussiemail.com.au/email/scripts/loginuser.pl', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('azet', 'Azet', 'azet', 1, 1, 'social', 'Get the contacts from a Azet account', 'user', 'http://emailnew.azet.sk/', '1.0.5', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('bigstring', 'Bigstring', 'bigstring', 0, 1, 'social', 'Get the contacts from an Bigstring account', 'user', 'http://www.bigstring.com/?old=1', '1.0.5', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'email'),
		('bordermail', 'Bordermail', 'bordermail', 0, 1, 'social', 'Get the contacts from a Bordermail account', 'user', 'http://www.boardermail.com/', '1.0.3', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('canoe', 'Canoe', 'canoe', 0, 1, 'social', 'Get the contacts from a Canoe account', 'user', 'http://www.canoe.ca/CanoeMail/', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('care2', 'Care2', 'care2', 0, 1, 'email', 'Get the contacts from a Care2 account', 'email', 'http://passport.care2.net/login.html?promoID=1', '1.0.4', '1.6.5', 'a:1:{i:0;s:5:\"care2\";}', 200, '', 0, 0, 'email'),
		('clevergo', 'Clevergo', 'clevergo', 0, 1, 'social', 'Get the contacts from a Clevergo account', 'user', 'http://www.clevergo.com/index.php', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'email'),
		('doramail', 'Doramail', 'doramail', 0, 1, 'social', 'Get the contacts from a Doramail account', 'user', 'http://www.doramail.com/scripts/common/index.main?signin=1&lang=us', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('evite', 'Evite', 'evite', 0, 1, 'social', 'Get the contacts from an Evite account', 'user', 'http://www.evite.com/', '1.0.4', '1.6.7', 'a:1:{i:0;s:5:\"evite\";}', 200, '', 0, 0, 'email'),
		('fastmail', 'FastMail', 'fastmail', 0, 1, 'email', 'Get the contacts from a FastMail account', 'email', 'http://www.fastmail.fm', '1.0.9', '1.6.3', 'a:1:{i:0;s:8:\"fastmail\";}', 200, '', 0, 0, 'email'),
		('fm5', '5Fm', 'fm5', 0, 1, 'social', 'Get the contacts from a 5fm.za.com account', 'user', 'http://www.5fm.za.com/', '1.0.3', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('freemail', 'Freemail', 'freemail', 0, 1, 'email', 'Get the contacts from a freemail.hu account', 'email', 'http://freemail.hu/', '1.0.5', '1.8.0', 'a:1:{i:0;s:8:\"freemail\";}', 200, '', 0, 0, 'email'),
		('gawab', 'Gawab', 'gawab', 0, 1, 'email', 'Get the contacts from a Gawab account', 'email', 'http://www.gawab.com/default.php', '1.0.4', '1.6.5', 'a:1:{i:0;s:5:\"gawab\";}', 200, '', 0, 0, 'email'),
		('gmail', 'Gmail', 'gmail', 1, 1, 'email', 'Get the contacts from a Gmail account', 'email', 'http://google.com', '1.4.8', '1.6.3', 'a:2:{i:0;s:5:\"gmail\";i:1;s:10:\"googlemail\";}', 1, 'gmail.com', 0, 0, 'email'),
		('gmx_net', 'GMX.net', 'gmx_net', 1, 1, 'email', 'Get the contacts from a GMX.net account', 'email', 'http://www.gmx.net', '1.1.0', '1.6.3', 'a:4:{i:0;s:3:\"gmx\";i:1;s:3:\"gmx\";i:2;s:3:\"gmx\";i:3;s:3:\"gmx\";}', 200, 'gmx.net', 0, 0, 'email'),
		('graffiti', 'Grafitti', 'graffiti', 0, 1, 'social', 'Get the contacts from a Graffiti account', 'user', 'http://www.graffiti.net/scripts/common/index.main?signin=1&lang=us', '1.0.2', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('hotmail', 'Live/Hotmail', 'hotmail', 1, 1, 'email', 'Get the contacts from a Windows Live/Hotmail account', 'email', 'http://login.live.com/login.srf?id=2', '1.6.4', '1.8.0', 'a:4:{i:0;s:7:\"hotmail\";i:1;s:4:\"live\";i:2;s:3:\"msn\";i:3;s:8:\"chaishop\";}', 3, 'hotmail.com', 0, 0, 'email'),
		('hushmail', 'Hushmail', 'hushmail', 0, 1, 'social', 'Get the contacts from an Hushmail account', 'user', 'https://m.hush.com/', '1.0.5', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('inbox', 'Inbox.com', 'inbox', 0, 1, 'email', 'Get the contacts from an Inbox.com account', 'email', 'https://www.inbox.com/xm/login.aspx', '1.0.6', '1.8.0', 'a:1:{i:0;s:5:\"inbox\";}', 4, 'inbox.com', 0, 0, 'email'),
		('india', 'India', 'india', 0, 1, 'social', 'Get the contacts from an India account', 'user', 'http://mail.india.com/scripts/common/index.main?signin=1&lang=us', '1.0.4', '1.6.3', 'a:0:{}', 200, '', 0, 0, 'email'),
		('indiatimes', 'IndiaTimes', 'indiatimes', 0, 1, 'social', 'Get the contacts from an IndiaTimes account', 'user', 'http://in.indiatimes.com/default1.cms', '1.0.7', '1.6.3', 'a:0:{}', 200, '', 0, 0, 'email'),
		('inet', 'Inet', 'inet', 0, 1, 'email', 'Get the contacts from a Inet account', 'email', 'http://inet.ua/index.php', '1.0.4', '1.6.5', 'a:2:{i:0;s:4:\"inet\";i:1;s:2:\"fm\";}', 200, '', 0, 0, 'email'),
		('interia', 'Interia', 'interia', 0, 1, 'email', 'Get the contacts from an Interia.pl account, Plugin developed by Bartosz Zarczynski', 'email', 'http://poczta.interia.pl/', '1.0.7', '1.8.0', 'a:10:{i:0;s:7:\"interia\";i:1;s:6:\"poczta\";i:2;s:7:\"interia\";i:3;s:3:\"1gb\";i:4;s:3:\"2gb\";i:5;s:3:\"vip\";i:6;s:6:\"serwus\";i:7;s:5:\"akcja\";i:8;s:8:\"czateria\";i:9;s:7:\"znajomi\";}', 200, '', 0, 0, 'email'),
		('katamail', 'KataMail', 'katamail', 0, 1, 'email', 'Get the contacts from a KataMail account', 'email', 'http://webmail.katamail.com', '1.1.0', '1.6.3', 'a:1:{i:0;s:8:\"katamail\";}', 200, '', 0, 0, 'email'),
		('kids', 'Kids', 'kids', 0, 1, 'social', 'Get the contacts from a Kids account', 'user', 'http://www.kids.co.uk/email/index.php', '1.0.2', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('libero', 'Libero', 'libero', 0, 1, 'email', 'Get the contacts from a Libero account', 'email', 'http://imodemail.libero.it/imodeaccess/', '1.0.4', '1.6.3', 'a:4:{i:0;s:6:\"libero\";i:1;s:6:\"inwind\";i:2;s:3:\"iol\";i:3;s:3:\"blu\";}', 200, '', 0, 0, 'email'),
		('linkedin', 'LinkedIn', 'linkedin', 1, 1, 'social', 'Get the contacts from a LinkedIn account', 'email', 'http://m.linkedin.com/session/new', '1.1.4', '1.8.0', 'a:0:{}', 4, '', 0, 0, 'email'),
		('lycos', 'Lycos', 'lycos', 0, 1, 'social', 'Get the contacts from a Lycos account', 'user', 'http://lycos.com', '1.1.5', '1.6.3', 'a:0:{}', 200, '', 0, 0, 'email'),
		('mail2world', 'Mail2World', 'mail2world', 0, 1, 'email', 'Get the contacts from a Mail2World account', 'email', 'http://www.mail2world.com/', '1.0.4', '1.6.5', 'a:1:{i:0;s:10:\"mail2world\";}', 200, '', 0, 0, 'email'),
		('mail_com', 'Mail.com', 'mail_com', 0, 1, 'email', 'Get the contacts from a Mail.com account', 'email', 'http://www.mail.com', '1.1.4', '1.6.3', 'a:0:{}', 200, '', 0, 0, 'email'),
		('mail_in', 'Mail.in', 'mail_in', 0, 1, 'email', 'Get the contacts from a Mail.in account', 'email', 'http://mail.in.com/', '1.0.3', '1.6.5', 'a:1:{i:0;s:2:\"in\";}', 200, '', 0, 0, 'email'),
		('mail_ru', 'Mail.ru', 'mail_ru', 0, 1, 'email', 'Get the contacts from a Mail.ru account', 'email', 'http://www.mail.ru', '1.1.4', '1.6.3', 'a:4:{i:0;s:4:\"list\";i:1;s:5:\"inbox\";i:2;s:2:\"bk\";i:3;s:4:\"mail\";}', 200, '', 0, 0, 'email'),
		('meta', 'Meta', 'meta', 0, 1, 'social', 'Get the contacts from a Meta account', 'user', 'http://meta.ua/', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('msn', 'MSN', 'msn', 0, 1, 'email', 'Get the contacts from a MSN People', 'email', 'http://home.mobile.live.com/', '1.0.1', '1.8.1', 'a:0:{}', 200, '', 0, 0, 'email'),
		('mynet', 'Mynet.com', 'mynet', 1, 1, 'social', 'Get the contacts from an Mynet account', 'user', 'http://uyeler.mynet.com/login/?loginRequestingURL=http%3A%2F%2Feposta.mynet.com%2Findex%2Fmymail.htm', '1.0.5', '1.6.3', 'a:0:{}', 200, '', 0, 0, 'email'),
		('netaddress', 'Netaddress', 'netaddress', 0, 1, 'email', 'Get the contacts from a Netaddress account', 'email', 'https://www.netaddress.com/', '1.0.4', '1.6.5', 'a:1:{i:0;s:10:\"netaddress\";}', 200, '', 0, 0, 'email'),
		('nz11', 'Nz11', 'nz11', 1, 1, 'social', 'Get the contacts from a Nz11 account', 'user', 'http://nz11.com/', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('o2', 'O2', 'o2', 0, 1, 'social', 'Get the contacts from a O2 account', 'user', 'http://poczta.o2.pl/', '1.0.2', '1.6.9', 'a:0:{}', 200, '', 0, 0, 'email'),
		('operamail', 'OperaMail', 'operamail', 0, 1, 'email', 'Get the contacts from an OperaMail account', 'email', 'http://www.operamail.com', '1.0.7', '1.6.0', 'a:1:{i:0;s:9:\"operamail\";}', 200, '', 0, 0, 'email'),
		('plaxo', 'Plaxo', 'plaxo', 1, 1, 'email', 'Get the contacts from a plaxo account', 'email', 'http://m.plaxo.com', '1.0.9', '1.8.0', 'a:0:{}', 200, 'plaxo.com', 0, 0, 'email'),
		('pochta', 'Pochta', 'pochta', 0, 1, 'email', 'Get the contacts from a Pochta account', 'email', 'http://www.pochta.ru/', '1.0.3', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('popstarmai', 'Popstarmail', 'popstarmail', 0, 1, 'email', 'Get the contacts from an Popstarmail account', 'email', 'http://super.popstarmail.org/', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('rambler', 'Rambler', 'rambler', 0, 1, 'email', 'Get the contacts from a Rambler account', 'email', 'http://www.rambler.ru', '1.1.6', '1.6.3', 'a:1:{i:0;s:7:\"rambler\";}', 200, '', 0, 0, 'email'),
		('rediff', 'Rediff', 'rediff', 0, 1, 'social', 'Get the contacts from a Rediff account', 'user', 'http://mail.rediff.com', '1.2.1', '1.8.1', 'a:0:{}', 200, '', 0, 0, 'email'),
		('sapo', 'Sapo.pt', 'sapo', 0, 1, 'email', 'Get the contacts from a Sapo.pt account', 'email', 'http://services.mail.sapo.pt/codebits/', '1.0.4', '1.6.7', 'a:1:{i:0;s:4:\"sapo\";}', 200, '', 0, 0, 'email'),
		('techemail', 'Techemail', 'techemail', 1, 1, 'social', 'Get the contacts from an Techemail account', 'user', 'http://techemail.mail.everyone.net/email/scripts/loginuser.pl', '1.0.3', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('terra', 'Terra', 'terra', 0, 1, 'social', 'Get the contacts from an Terra account', 'user', 'http://correo.terra.com/', '1.0.8', '1.6.7', 'a:0:{}', 200, '', 0, 0, 'email'),
		('uk2', 'Uk2', 'uk2', 0, 1, 'social', 'Get the contacts from a Uk2 account', 'user', 'http://mail.uk2.net/', '1.0.3', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('virgilio', 'Virgilio', 'virgilio', 0, 1, 'social', 'Get the contacts from an virgilio.it account', 'user', 'http://mobimail.virgilio.it/cp/ps/Main/login/LoginVirgilio?d=virgilio.it', '1.0.3', '1.0.0', 'a:0:{}', 200, '', 0, 0, 'email'),
		('walla', 'Walla', 'walla', 0, 1, 'social', 'Get the contacts from a Walla mail account', 'user', 'http://friends.walla.co.il/?tsscript=login&theme=&ReturnURL=http://mail.walla.co.il/index.cgi', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('web_de', 'Web.de', 'web_de', 0, 1, 'social', 'Get the contacts from an web.de account', 'user', 'http://m.web.de', '1.0.6', '1.6.7', 'a:0:{}', 200, '', 0, 0, 'email'),
		('wpl', 'Wp.pt', 'wpl', 0, 1, 'social', 'Get the contacts from an Wp.pt account', 'user', 'http://wap.poczta.wp.pl/', '1.0.4', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('xing', 'Xing', 'xing', 0, 1, 'email', 'Get the contacts from a Xing account', 'email', 'https://mobile.xing.com/', '1.0.7', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'email'),
		('yahoo', 'Yahoo!', 'yahoo', 1, 1, 'email', 'Get the contacts from a Yahoo! account', 'email', 'http://mail.yahoo.com', '1.5.4', '1.8.0', 'a:3:{i:0;s:5:\"yahoo\";i:1;s:5:\"ymail\";i:2;s:10:\"rocketmail\";}', 2, 'yahoo.com', 0, 0, 'email'),
		('yandex', 'Yandex', 'yandex', 0, 1, 'email', 'Get the contacts from a Yandex account', 'email', 'http://yandex.ru', '1.1.1', '1.6.3', 'a:1:{i:0;s:6:\"yandex\";}', 200, '', 0, 0, 'email'),
		('youtube', 'YouTube', 'youtube', 1, 1, 'social', 'Get the contacts from a YouTube account AddressBook ', 'user', 'http://www.youtube.com', '1.0.2', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'email'),
		('zapak', 'Zapakmail', 'zapak', 0, 1, 'social', 'Get the contacts from an Zapakmail account', 'user', 'http://www.zapak.com/zapakmail.zpk', '1.0.3', '1.6.5', 'a:0:{}', 200, '', 0, 0, 'email'),
		('badoo', 'Badoo', 'badoo', 0, 1, 'social', 'Get the contacts from a badoo.com account', 'email', 'http://www.badoo.com/', '1.0.5', '1.6.7', 'a:0:{}', 200, '', 0, 0, 'social'),
		('bebo', 'Bebo', 'bebo', 0, 1, 'social', 'Get the contacts from a Bebo account', 'user', 'http://www.bebo.com/', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('bookcrossi', 'Bookcrossing', 'bookcrossing', 0, 1, 'social', 'Get your frineds from a bookcrossing.com account and sends private messages', 'email', 'http://www.bookcrossing.com/', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('brazencare', 'Brazencareerist', 'brazencareerist', 0, 1, 'social', 'Get the contacts from a Brazencareerist account', 'email', 'http://www.brazencareerist.com/', '1.0.3', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('cyworld', 'Cyworld', 'cyworld', 0, 1, 'social', 'Get the contacts from a Cyworld account', 'email', 'http://us.cyworld.com/', '1.0.7', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('eons', 'Eons', 'eons', 0, 1, 'social', 'Get the contacts from a Eons account', 'email', 'http://www.eons.com/', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('facebook_', 'Facebook', 'facebook_', 1, 1, 'social', 'Get the contacts from a Facebook account', 'email', 'http://apps.facebook.com/causes/', '1.2.7', '1.8.0', 'a:0:{}', 1, '', 1, 1, 'social'),
		('faces', 'Faces', 'faces', 0, 1, 'social', 'Get the contacts from a Faces account', 'user', 'http://www.faces.com/', '1.0.6', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('famiva', 'Famiva', 'famiva', 1, 1, 'social', 'Get the contacts from a Famiva account', 'email', 'http://www.famiva.com/', '1.0.3', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('fdcareer', 'Fdcareer', 'fdcareer', 1, 1, 'social', 'Get the contacts from a Fdcareer account', 'email', 'http://www.fdcareer.com/user/login', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('flickr', 'Flickr', 'flickr', 1, 1, 'social', 'Get the contacts from a Flickr account', 'email', 'http://www.flickr.com', '1.0.8', '1.8.0', 'a:0:{}', 200, 'flickr.com', 0, 0, 'social'),
		('flingr', 'Flingr', 'flingr', 0, 1, 'social', 'Get the contacts from a Flingr account', 'email', 'http://www.flingr.com/index.php', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('flixster', 'Flixster', 'flixster', 0, 1, 'social', 'Get the contacts from a Flixster account', 'email', 'http://www.flixster.com/', '1.0.7', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('friendfeed', 'Friendfeed', 'friendfeed', 1, 1, 'social', 'Get the contacts from a Friendfeed account', 'email', 'https://friendfeed.com/', '1.0.5', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('friendster', 'Friendster', 'friendster', 0, 1, 'social', 'Get the contacts from a Friendster account', 'email', 'http://www.friendster.com', '1.1.0', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('hi5', 'Hi5', 'hi5', 0, 1, 'social', 'Get the contacts from a Hi5 account', 'email', 'http://www.hi5.com', '1.1.7', '1.6.7', 'a:0:{}', 5, '', 0, 0, 'social'),
		('hyves', 'Hyves', 'hyves', 1, 1, 'social', 'Get the contacts from a Hyves account', 'user', 'http://www.hyves.nl/?l1=mo', '1.1.8', '1.8.1', 'a:0:{}', 200, '', 0, 0, 'social'),
		('kincafe', 'Kincafe', 'kincafe', 1, 1, 'social', 'Get the contacts from a kincafe.com account', 'email', 'http://www.kincafe.com/', '1.0.3', '1.6.7', 'a:0:{}', 200, '', 0, 0, 'social'),
		('konnects', 'Konnects', 'konnects', 0, 1, 'social', 'Get the contacts from a Konnects account', 'email', 'http://www.konnects.com/', '1.0.5', '1.6.7', 'a:0:{}', 200, '', 0, 0, 'social'),
		('koolro', 'Koolro', 'koolro', 1, 1, 'social', 'Get the contacts from a Koolro account', 'user', 'http://www.koolro.com/', '1.0.1', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('lastfm', 'Last.fm', 'lastfm', 1, 1, 'social', 'Get the contacts from a Last.fm account', 'user', 'http://www.last.fm', '1.0.5', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('livejourna', 'Livejournal', 'livejournal', 0, 1, 'social', 'Get the contacts from a Livejournal account', 'user', 'http://www.livejournal.com/mobile/', '1.0.5', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('lovento', 'Lovento', 'lovento', 0, 1, 'social', 'Get the contacts from a Lovento account', 'user', 'http://www.lovento.com/', '1.0.3', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('meinvz', 'Meinvz', 'meinvz', 0, 1, 'social', 'Get the contacts from a MeinVz account', 'email', 'http://www.meinvz.net/', '1.0.9', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('mevio', 'Mevio', 'mevio', 1, 1, 'social', 'Get the contacts from a Mevio account', 'email', 'http://www.mevio.com/', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('motortopia', 'Motortopia', 'motortopia', 1, 1, 'social', 'Get the contacts from a Motortopia account', 'email', 'http://www.motortopia.com/main/cars', '1.0.3', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('multiply', 'Multiply', 'multiply', 0, 1, 'social', 'Get the contacts from a Multiply account', 'user', 'http://multiply.com/', '1.0.5', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('mycatspace', 'Mycatspace', 'mycatspace', 1, 1, 'social', 'Get the contacts from a mycatspace account', 'user', 'http://www.mycatspace.com/', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('mydogspace', 'Mydogspace', 'mydogspace', 0, 1, 'social', 'Get the contacts from a mydogspace account', 'user', 'http://www.mydogspace.com/', '1.0.4', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('myspace', 'MySpace', 'myspace', 1, 1, 'social', 'Get the contacts from a MySpace account', 'email', 'http://www.myspace.com', '1.1.1', '1.8.0', 'a:0:{}', 3, '', 1, 1, 'social'),
		('netlog', 'NetLog', 'netlog', 1, 1, 'social', 'Get the contacts from a NetLog account And Shout a message to your friends', 'email', 'http://en.netlog.com/m/login', '1.0.6', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('ning', 'Ning', 'ning', 0, 1, 'social', 'Get the contacts from a ning account', 'email', 'http://www.ning.com/', '1.0.1', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('orkut', 'Orkut', 'orkut', 0, 1, 'social', 'Get the contacts from an Orkut account', 'email', 'http://www.orkut.com/', '1.1.6', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('perfspot', 'Perfspot', 'perfspot', 1, 1, 'social', 'Get the contacts from a Perfspot account', 'email', 'http://m.perfspot.com/index.asp', '1.0.7', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('plazes', 'Plazes', 'plazes', 0, 1, 'social', 'Get the contacts from a Plazes account', 'email', 'http://www.plazes.com/', '1.0.3', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('plurk', 'Plurk', 'plurk', 1, 1, 'social', 'Get the contacts from a Plurk account', 'email', 'http://www.plurk.com/', '1.0.7', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('skyrock', 'Skyrock', 'skyrock', 0, 1, 'social', 'Get the contacts from a Skyrock account', 'user', 'http://www.skyrock.com/', '1.0.8', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('tagged', 'Tagged', 'tagged', 0, 1, 'social', 'Get the contacts from a Tagged.com account', 'email', 'http://www.tagged.com/home.html', '1.0.9', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('twitter', 'Twitter', 'twitter', 1, 1, 'social', 'Get the contacts from a Twitter account', 'user', 'http://twitter.com', '1.1.1', '1.8.0', 'a:0:{}', 2, '', 1, 1, 'social'),
		('vimeo', 'Vimeo', 'vimeo', 0, 1, 'social', 'Get the contacts from a Vimeo account', 'email', 'http://vimeo.com/', '1.0.3', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('vkontakte', 'Vkontakte', 'vkontakte', 0, 1, 'social', 'Get the contacts from a Vkontakte.ru account', 'email', 'http://vkontakte.ru', '1.0.3', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('xanga', 'Xanga', 'xanga', 0, 1, 'social', 'Get the contacts from a Xanga account', 'user', 'http://www.xanga.com/', '1.0.6', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social'),
		('xuqa', 'Xuqa', 'xuqa', 0, 1, 'social', 'Get the contacts from a Xuqa account', 'email', 'http://xuqa.com/login.php?dest=%2Findex.php&query_str=', '1.0.5', '1.8.0', 'a:0:{}', 200, '', 0, 0, 'social')";
	Phpfox::getLib('phpfox.database')->query($sql);
}

function contactimporter_max_invitations()
{		
	$sTable = Phpfox::getT('contactimporter_max_invitations');
	$sql = "CREATE TABLE IF NOT EXISTS `$sTable` (
		`id_max_invitation` int(11) NOT NULL AUTO_INCREMENT,
		`id_user_group` int(11) NOT NULL,
		`number_invitation` int(11) NOT NULL,
		PRIMARY KEY (`id_max_invitation`)
	) ENGINE=MyISAM AUTO_INCREMENT=1;";
	Phpfox::getLib('phpfox.database')->query($sql);
}

function contactimporter_statistics()
{
	$sTable = Phpfox::getT('contactimporter_statistics');
	$sql = "CREATE TABLE IF NOT EXISTS `$sTable` (
		`statictis_id` int(11) NOT NULL AUTO_INCREMENT,
		`user_id` int(11) NOT NULL,
		`emails` int(11) DEFAULT '0',
		`socials` int(11) DEFAULT '0',
		PRIMARY KEY (`statictis_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
	Phpfox::getLib('phpfox.database')->query($sql);
}

function contactimporter_api_settings()
{
	$sTable = Phpfox::getT('contactimporter_api_settings');
	$sql = "CREATE TABLE IF NOT EXISTS `$sTable` (
		`api_id` int(11) NOT NULL AUTO_INCREMENT,
		`api_name` varchar(50) NOT NULL,
		`api_params` text NOT NULL,
		PRIMARY KEY (`api_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
	Phpfox::getLib('phpfox.database')->query($sql);
}

function contactimporter_settings()
{
	$sTable = Phpfox::getT('contactimporter_settings');
	$sql = "CREATE TABLE IF NOT EXISTS `$sTable` (
		`settings_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`settings_type` varchar(100) NOT NULL,
		`param_values` int(10) NOT NULL DEFAULT '1',
		PRIMARY KEY (`settings_id`),
		UNIQUE KEY `settings_type` (`settings_type`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
	Phpfox::getLib('phpfox.database')->query($sql);
}

function contactimporter()
{
	$sTable = Phpfox::getT('contactimporter');
	$sql = "CREATE TABLE IF NOT EXISTS `$sTable` (
		`contactimporter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`user_id` int(10) NOT NULL,
		`provider` varchar(50) NOT NULL,
		`contactimporter_user_id` varchar(200) NOT NULL,
		`time_stamp` int(10) NOT NULL,
		PRIMARY KEY  (`contactimporter_id`),
		UNIQUE KEY `contactimporter_user_id` (`contactimporter_user_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
	Phpfox::getLib('phpfox.database')->query($sql);
}

function contactimporter_unsubscribe()
{
	$sTable = Phpfox::getT('contactimporter_unsubscribe');
	$sql = "CREATE TABLE IF NOT EXISTS `$sTable` (
		`unsubscribe_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`email` varchar(100) NOT NULL,
		`time_stamp` int(10) unsigned NOT NULL,
		PRIMARY KEY (`unsubscribe_id`),
		UNIQUE KEY `email` (`email`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
	Phpfox::getLib('phpfox.database')->query($sql);
}

contactimporter_providers();
contactimporter_max_invitations();
contactimporter_statistics();
contactimporter_api_settings();
contactimporter_settings();
contactimporter_unsubscribe();
contactimporter();

Phpfox::getLib('phpfox.database')->query("UPDATE " . Phpfox::getT('menu') . " SET is_active = 1 WHERE menu_id = 64;");
?>