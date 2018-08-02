-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 02 Ağu 2018, 12:54:56
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `vb2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_posta` varchar(300) NOT NULL,
  `admin_sifre` varchar(300) NOT NULL,
  `admin_isim` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_posta`, `admin_sifre`, `admin_isim`) VALUES
(1, 'deneme@deneme.com', 'adcd7048512e64b48da55b027577886ee5a36350', 'admin'),
(2, 'yunusemrex@gmail.com', '9aa650b1873c02da15a608720113c14567637fbb', 'Yunus Emre Ekinci');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `ayar_id` int(11) NOT NULL,
  `site_url` varchar(300) NOT NULL,
  `site_baslik` varchar(300) NOT NULL,
  `site_keyw` varchar(300) NOT NULL,
  `site_desc` varchar(300) NOT NULL,
  `site_duyuru` text NOT NULL,
  `site_footer` varchar(300) NOT NULL,
  `site_apikey` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`ayar_id`, `site_url`, `site_baslik`, `site_keyw`, `site_desc`, `site_duyuru`, `site_footer`, `site_apikey`) VALUES
(1, 'http://localhost/vb2', 'yenidizi.club', 'yenidizi.club', 'yenidizi.club', 'yenidizi.club', 'Yavuz Selim ŞAHİN -2017 x', 'AIzaSyCM5jaVAHWTEnCvu0SbF1yenwu QedevmAc');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `ana_kategori_id` int(10) NOT NULL,
  `kategori_adi` varchar(250) NOT NULL,
  `kategori_durum` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `ana_kategori_id`, `kategori_adi`, `kategori_durum`) VALUES
(1, 0, 'Yerli', '1'),
(2, 0, 'Yabancı', '1'),
(3, 1, 'Yeni', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `oneriler`
--

CREATE TABLE `oneriler` (
  `oneri_id` int(11) NOT NULL,
  `oneri_isim` varchar(300) NOT NULL,
  `oneri_posta` varchar(300) NOT NULL,
  `oneri_video` varchar(300) NOT NULL,
  `oneri_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `videolar`
--

CREATE TABLE `videolar` (
  `video_id` int(11) NOT NULL,
  `video_kat` int(10) NOT NULL,
  `video_ustkat` int(10) NOT NULL,
  `video_sahibi` varchar(300) NOT NULL,
  `video_baslik` varchar(300) NOT NULL,
  `video_sef_baslik` varchar(300) NOT NULL,
  `video_resim` varchar(300) NOT NULL,
  `video_url` varchar(300) NOT NULL,
  `video_aciklama` text NOT NULL,
  `video_eklemetarihi` varchar(200) NOT NULL,
  `video_goruntulenme` int(11) NOT NULL,
  `video_durum` int(2) NOT NULL,
  `video_tavsiye` int(2) NOT NULL,
  `video_etiketler` text NOT NULL,
  `video_sefetiketler` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `videolar`
--

INSERT INTO `videolar` (`video_id`, `video_kat`, `video_ustkat`, `video_sahibi`, `video_baslik`, `video_sef_baslik`, `video_resim`, `video_url`, `video_aciklama`, `video_eklemetarihi`, `video_goruntulenme`, `video_durum`, `video_tavsiye`, `video_etiketler`, `video_sefetiketler`) VALUES
(2, 0, 0, 'ŞENOL HOCA', 'TYT 10\'LU DENEME-1 ÇÖZÜM | ŞENOL HOCA (Emrah Hoca)', 'tyt-10-lu-deneme-1-cozum-senol-hoca-emrah-hoca', 'https://i.ytimg.com/vi/2d-8J9ImIdQ/mqdefault.jpg', '2d-8J9ImIdQ', 'KİTAPLARI İNCELEMEK - SATIN ALMAK İÇİN TIKLAYIN:\r\nhttps://senolhocamagaza.com/\r\n\r\nhttps://www.youtube.com/channel/UCih3R0sl4WV_gVs6LhOhmLg\r\n\r\nhttps://www.instagram.com/emrh.hoca/?hl=tr', '17.Jul.2018 03:26:01', 0, 2, 0, 'matematik, geometri, ders, konu, anlatımı, tyt, yks, lgs, şenolhoca, emrahhoca, tytdeneme, deneme,', 'matematik,geometri,ders,konu,anlatimi,tyt,yks,lgs,senolhoca,emrahhoca,tytdeneme,deneme,'),
(3, 0, 0, 'netd müzik', 'Merve Özbey - Vuracak', 'merve-ozbey---vuracak', 'https://i.ytimg.com/vi/wRVekDWb47I/mqdefault.jpg', 'wRVekDWb47I', 'Merve Özbey\'in, Özdemir Müzik etiketiyle yayınlanan \"Yıldız Tilbe\'nin Yıldızlı Şarkıları\" albümünde yer alan \"Vuracak\" isimli şarkısı, video klibiyle netd müzik\'te.\r\n\r\nSöz & Müzik: Yıldız Tilbe\r\nDüzenleme: Batu Çaldıran\r\nYönetmen: Onur Sarsıcı\r\n\r\nTürkçe Pop oynatma listesi: http://bit.ly/ndm-turkcepop\r\nYeni Hit Şarkılar: http://bit.ly/ndm-hitsarkilar\r\nnetd müzik’te bu ay: http://bit.ly/ndm-enyeniler\r\n\r\n\"Vuracak\" şarkı sözleri ile\r\n    \r\nBu kadarı az mı\r\nYeter, tükendi içim\r\nZorsun zor\r\nŞşşt! Kenara çekil\r\nBiter burada\r\nZorla değil\r\nSuçu günahı boynuma bırak kabulüm\r\nYeter ki düş yakamdan aman\r\nCanım yoluna feda değil\r\n\r\nKime böyle dalıp gitmelerin\r\nSon bakışıydım ya gözlerinin\r\nDağıttığın bu ev ve ben şahidim\r\nSeni vuracak yeminlerin\r\n\r\nArdından yıkılmam unuturum\r\nYalan aşkından büyük gururum\r\nYazarım hasretini de tarihe\r\nSoyunur yine aşka ruhum\r\n\r\nSana ne sabır, ne yürek dayanmaz inan\r\nÇatlar taş\r\nUfff! Yalanı bırak\r\nAllah aşkına, aşkı öğren\r\nZararı ziyanı bana\r\nSefası sana, haramdır\r\nSuç arama boşa\r\nÇözüm getirmez ayrılığa\r\n\r\nKime böyle dalıp gitmelerin\r\nSon bakışıydım ya gözlerinin\r\nDağıttığın bu ev ve ben şahidim\r\nSeni vuracak yeminlerin\r\n\r\nArdından yıkılmam unuturum\r\nYalan aşkından büyük gururum\r\nYazarım hasretini de tarihe\r\nSoyunur yine aşka ruhum\r\n\r\nnetd müzik, Facebook\'ta, http://bit.ly/ndm-facebook\r\naynı zamanda Twitter\'da, http://bit.ly/ndm-twitter\r\nbir de Instagram\'da! http://bit.ly/ndm-insta\r\nve Spotify\'da: http://spoti.fi/2GbWAEx\r\npeki YouTube kanalımıza abone oldunuz mu? http://bit.ly/2d8ihWS', '18.Jul.2018 07:30:22', 1, 1, 1, 'netd Müzik, Turkish Music, música, Musik, musiqi, музика, muziek, musique, музыка, musiqaa, موسيقى, Türkçe Müzik, Turkish Pop, 2018 türkçe pop, pop şarkılar, şarkılar, şarkı, müzik, \'Türkçe, pop\', Damar, Hit Şarkılar, 2018 hit şarkılar, izle, klip, dinle, Aşk Şarkıları, top 10, top 20, yabancı şarkılar, en hit, çok dinlenen, yeni şarkılar, en yeni şarkılar, turca musica, Official, Oficial, Offical, netd, Merve Özbey, Vuracak, Yıldız Tilbe, Yıldızlı Şarkılar, cover,', 'netd-muzik,turkish-music,m-sica,musik,musiqi,,muziek,musique,,musiqaa,,turkce-muzik,turkish-pop,2018-turkce-pop,pop-sarkilar,sarkilar,sarki,muzik,turkce,pop,damar,hit-sarkilar,2018-hit-sarkilar,izle,klip,dinle,ask-sarkilari,top-10,top-20,yabanci-sarkilar,en-hit,cok-dinlenen,yeni-sarkilar,en-yeni-sarkilar,turca-musica,official,oficial,offical,netd,merve-ozbey,vuracak,yildiz-tilbe,yildizli-sarkilar,cover,'),
(4, 0, 1, 'STARTVSTAR', 'Yeni dizi Erkenci Kuş yakında Star\'da!', 'yeni-dizi-erkenci-kus-yakinda-star-da', 'https://i.ytimg.com/vi/RrPFXWenx10/mqdefault.jpg', 'RrPFXWenx10', 'Erkenci Kuş Starda', '31.Jul.2018 01:55:40', 0, 1, 0, 'erkenci kuş,', 'erkenci-kus,'),
(5, 0, 0, 'Parola HD', 'Darısı Başımıza - Fragmanı Yeni Dizi Show tv', 'darisi-basimiza---fragmani-yeni-dizi-show-tv', 'https://i.ytimg.com/vi/zhgbrkrgHSA/mqdefault.jpg', 'zhgbrkrgHSA', 'Darısı Başımıza', '31.Jul.2018 02:00:11', 0, 1, 0, 'Darışı Başımıza,', 'darisi-basimiza,'),
(6, 0, 0, 'Ege\'nin Hamsisi', 'Egenin Hamsisi 1.Bölüm', 'egenin-hamsisi-1bolum', 'https://i.ytimg.com/vi/M6eqniYg0s8/mqdefault.jpg', 'M6eqniYg0s8', 'Kanala abone olmak için: http://bit.ly/egeninhamsisi\r\n\r\n======================================\r\n\r\nEge\'nin Hamsisi Her Pazartesi TRT1 \'de!\r\n\r\n======================================\r\n\r\nBizi Sosyal Medyada Takip Edin!\r\nhttps://www.facebook.com/EgeninHamsisi\r\nhttps://www.instagram.com/egeninhamsisi\r\nhttps://twitter.com/egeninhamsisi\r\n\r\n======================================\r\n\r\nGenl Hikaye\r\n\r\nGönüller Bir Olsun “Ege’nin Hamsisi” doksanlı yıllardan kalma, deniz kenarında yeşil-mavi bir ege kasabası ve bu kasabanın amaçları, tutumları ve de tasarrufları ne olursa olsun hatırşinas insanlarının hikâyesidir.\r\n\r\nKasabalıların bir arada büyük bir aile gibi yaşadığı, sevginin ve birliğin her şeyden önce geldiği bu güzel Ege toprağında bir Karadeniz lokantası açılmasıyla işler karışır. Bakir yaşamlarını, kendi küçük savaşlarını, bu güneşin elini en son çektiği topraklarda nice zamandır devam ettirmekte olan kahramanlar, tatlı bir Karadeniz-Ege çekişmesine tutulur.\r\n\r\nGeçmişlerinin tatlı-soğuk imbatında neşeli, çok büyük cümleleri olmayan, hiç açılmamış mektuplarla yaşamaya devam eden bu Ege kasabası, büyük bir aşka şahit olacak ve bu çekişmenin tarafları uzlaşmanın yollarını arayacaklardır.\r\n\r\nYerlisiyle, esnafıyla, öğrencisiyle, gezginiyle şenlenen kasabada dillere destan bir aşk filizlenip büyüyecektir. Bu davul zurna ve kemençe, börülce karalahana, zeytinyağı tereyağı savaşı; geçmişlerin, arkadaşlıkların, hoşlanmaların, kıskançlıkların da işin içine dahil olmasıyla, fonda Ege-Karadeniz müzikleriyle iyice eğlenceli bir hal alacaktır.\r\n\r\nBazen düşmanlıklar, kısmi dostluklara; puslu geçmişler, başkalarının oluşmamış geleceklerine dönüşecek, bazen de “asla dönmem kararımdan! “ ya da “başkalarına bakmam bu saatten sonra!“ naraları terslerine dönüşüverir, bu yeni kasaba nizamında.\r\nAma ne olursa olsun asla kötü, fesat ya da içten pazarlıklı olanlar kazanamaz akşam rüzgârları kireçli duvarları aşındırmaya yüz tutmuşken, gerçek yaşamın aksine uzayıp giden dar yollarıyla ulaşılması zor bu Ege kasabası, kocaman dünya düzeninde kâh eğlenceli kâh hüzünlü ama ne olursa olsun insancıl kanunlarıyla bir masal gibi evvel zaman içerisinde sahnesini alarak yaşamına devam eder ve de öylece gider, vesselam.\r\n\r\n======================================\r\n\r\nYapımcılığını Köprü Film-Ferhat Eşsiz, yönetmenliğini Mustafa Şevki Doğan’ın üstlendiği, senaryosunu Bahar Filiz Ekinci’nin kaleme aldığı dizide, başrolleri İclal Aydın, Uğur Çavuşoğlu, Uraz Kaygılaroğlu, Bestemsu Özdemir, Asuman Dabak, Eser Eyüboğlu ve Hakan Bilgin paylaşıyor.\r\n\r\nDaha Fazla Bilgi İçin: https://www.trt1.com.tr/diziler/egenin-hamsisi', '31.Jul.2018 02:00:38', 0, 1, 0, 'Ege\'nin Hamsisi, Egenin Hamsisi, trt1, egenin hamsisi trt1, trt egenin hamsisi, trt1 dizileri, yeni dizi, trt1 fragman, ege dizisi, karadeniz dizisi, karadeniz, ege, kasaba dizisi, egenin hamsisi 1.bölüm, egenin hamsisi bölüm, İclal Aydın, Uğur Çavuşoğlu, Uraz Kaygılaroğlu, Bestemsu Özdemir, Asuman Dabak, Eser Eyüboğlu, Hakan Bilgin,', 'ege-nin-hamsisi,egenin-hamsisi,trt1,egenin-hamsisi-trt1,trt-egenin-hamsisi,trt1-dizileri,yeni-dizi,trt1-fragman,ege-dizisi,karadeniz-dizisi,karadeniz,ege,kasaba-dizisi,egenin-hamsisi-1bolum,egenin-hamsisi-bolum,iclal-aydin,ugur-cavusoglu,uraz-kaygilaroglu,bestemsu-ozdemir,asuman-dabak,eser-eyuboglu,hakan-bilgin,'),
(7, 0, 0, 'SineLine Film Yapım', 'ÇAM YARMASI KOMEDİ FİLMİ 2018 TEK PARÇA FULL HD', 'cam-yarmasi-komedi-filmi-2018-tek-parca-full-hd', 'https://i.ytimg.com/vi/HEgwR2CKnPY/mqdefault.jpg', 'HEgwR2CKnPY', 'Çam Yarması Yerli Komedi Filmi Tek Parça Full HD 2018\r\nUYARI: Tüm Hakları Tarafımıza aittir. Herhangi bir nedenle tümünün veya bir bölümünün Kopyalanması veya\r\nYeniden herhangi bir yayın mecrasına yüklenmesi halinde ivedilikle hukuki işlem başlatılacaktır.!\r\nİletişim: 0312 231 01 05 - 0532 507 62 06', '31.Jul.2018 02:02:06', 0, 1, 0, 'Çam Yarması izle, komedi filmi izle, yerli komedi filmleri, komik filmler, film izle, yerli komedi izle, 2018 komedi filmleri, sinema filmleri, Türk komedi izle, Türk Komedi filmleri, çam yarması komedi filmi izle, çam yarması full izle, çam yarması tek parça, cam yarmasi izle, komedi filmleri tek parça, 2017 komedi filmleri, vizyon filmleri izle, en komik filmler, tek parça full hd, en komik yerli komedi, türk filmi izle, türk komedi filmleri, yönetmen sefa özçelik,', 'cam-yarmasi-izle,komedi-filmi-izle,yerli-komedi-filmleri,komik-filmler,film-izle,yerli-komedi-izle,2018-komedi-filmleri,sinema-filmleri,turk-komedi-izle,turk-komedi-filmleri,cam-yarmasi-komedi-filmi-izle,cam-yarmasi-full-izle,cam-yarmasi-tek-parca,cam-yarmasi-izle,komedi-filmleri-tek-parca,2017-komedi-filmleri,vizyon-filmleri-izle,en-komik-filmler,tek-parca-full-hd,en-komik-yerli-komedi,turk-filmi-izle,turk-komedi-filmleri,yonetmen-sefa-ozcelik,'),
(8, 0, 0, 'snoopyy', 'Yanlış Anlama   Komedi Film   Full İzle  yerli filmler', 'yanlis-anlama-komedi-film-full-izle-yerli-filmler', 'https://i.ytimg.com/vi/IHwm4TisvpE/mqdefault.jpg', 'IHwm4TisvpE', 'yerli komedi filmi\r\ntürk azeri kardeşliği \r\ngardaş hanıma bir sok :)\r\nyeni filmler için lütfen kanalıma olunuz', '31.Jul.2018 02:02:22', 0, 1, 0, 'yanlış anlama', 'yanlis-anlama'),
(9, 0, 2, 'Hulu', 'Castle Rock: Official Trailer • A Hulu Original', 'castle-rock-official-trailer-a-hulu-original', 'https://i.ytimg.com/vi/gXsKCQenpt0/mqdefault.jpg', 'gXsKCQenpt0', 'In answer to a mysterious phone call from Shawshank, Henry Deaver returns home to #CastleRock.  From Stephen King and J.J. Abrams, Castle Rock now streaming. New episodes Wednesdays. \r\n\r\nABOUT CASTLE ROCK\r\nA psychological-horror series set in the Stephen King multiverse, Castle Rock combines the mythological scale and intimate character storytelling of King’s best-loved works, weaving an epic saga of darkness and light, played out on a few square miles of Maine woodland. The fictional Maine town of Castle Rock has figured prominently in King’s literary career: Cujo, The Dark Half, IT and Needful Things, as well as novella The Body and numerous short stories such as Rita Hayworth and The Shawshank Redemption are either set there or contain references to Castle Rock. Castle Rock is an original suspense/thriller — a first-of-its-kind reimagining that explores the themes and worlds uniting the entire King canon, while brushing up against some of his most iconic and beloved stories.\r\n\r\nWATCH CASTLE ROCK HERE: https://hulu.tv/CastleRockOnHuluYT\r\n\r\nSUBSCRIBE TO HULU’S YOUTUBE CHANNEL \r\nClick the link to subscribe to our channel for the latest shows & updates: http://www.youtube.com/hulu?sub_confirmation=1 \r\n\r\nSTART YOUR FREE TRIAL http://hulu.com/start', '31.Jul.2018 03:27:15', 20, 1, 1, 'hulu, Castle rock, stephen king, hulu original, sissy spacek, andre holland, bill skarsgard, jane levy, horror, horror show,', 'hulu,castle-rock,stephen-king,hulu-original,sissy-spacek,andre-holland,bill-skarsgard,jane-levy,horror,horror-show,');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `yorum_id` int(11) NOT NULL,
  `yorum_video_id` int(11) NOT NULL,
  `yorum_isim` varchar(300) NOT NULL,
  `yorum_eposta` varchar(300) NOT NULL,
  `yorum_website` varchar(300) NOT NULL,
  `yorum_icerik` text NOT NULL,
  `yorum_durum` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `oneriler`
--
ALTER TABLE `oneriler`
  ADD PRIMARY KEY (`oneri_id`);

--
-- Tablo için indeksler `videolar`
--
ALTER TABLE `videolar`
  ADD PRIMARY KEY (`video_id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`yorum_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `ayar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `oneriler`
--
ALTER TABLE `oneriler`
  MODIFY `oneri_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `videolar`
--
ALTER TABLE `videolar`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `yorum_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
