DROP DATABASE IF EXISTS book_store;

CREATE DATABASE book_store;
USE book_store;

--
-- Table structure for table `UserAccount`
--
DROP TABLE IF EXISTS `UserAccount`;
CREATE TABLE `UserAccount` (
  `ID` int(10) AUTO_INCREMENT COMMENT 'ID',
  `Account` varchar(12) NOT NULL DEFAULT '' COMMENT '賬號名稱',
  `Password` varchar(15) NOT NULL DEFAULT '' COMMENT '密碼', 
  `Phone` varchar(20) NOT NULL DEFAULT '' COMMENT '電話',
  `Birth` DATE NOT NULL DEFAULT '1999-01-01' COMMENT '生日',
  `Address` varchar(35) NOT NULL COMMENT '地址',
  `Email` varchar(35) NOT NULL COMMENT '電子郵件',
  PRIMARY KEY (`ID`),
  unique (`Account`),
  unique (`Email`)
) COMMENT '會員';
ALTER TABLE `UserAccount` AUTO_INCREMENT=1001;

--
-- Table structure for table `Admin`
--
DROP TABLE IF EXISTS `CLerk`;
CREATE TABLE `CLerk` (
  `ID` int(10) AUTO_INCREMENT COMMENT 'ID',
  `Account` varchar(12) NOT NULL DEFAULT '' COMMENT '賬號名稱',
  `Password` varchar(15) NOT NULL DEFAULT '' COMMENT '密碼', 
  PRIMARY KEY (`ID`),
  unique (`Account`)
) COMMENT '店員';
ALTER TABLE `CLerk` AUTO_INCREMENT=5001;

--
-- Table structure for table `Book`
--
DROP TABLE IF EXISTS `Book`;
CREATE TABLE `Book`(
  `ID` int(11) auto_increment COMMENT 'ID',
  `ISBN` varchar(13) NOT NULL DEFAULT '' COMMENT 'ISBN',
  `Name` varchar(100) NOT NULL DEFAULT '' COMMENT '書名',
  `Date` DATE NOT NULL DEFAULT '1999-01-01' COMMENT '出版日期',
  `Price` int(8) NOT NULL DEFAULT 0 COMMENT '價格',
  `Publisher` varchar(50) COMMENT '出版社',
  `Author` varchar(50) COMMENT '作者',
  `Quantity` int(3) NOT NULL DEFAULT 0 COMMENT '數量',
  `Image_Path` varchar(100) NOT NULL COMMENT '圖片路徑',
  `Introduction` varchar(500) COMMENT '書籍介紹',
  PRIMARY KEY (`ID`, `ISBN`)
) COMMENT '書籍';
ALTER TABLE `Book` AUTO_INCREMENT=2001;

--
-- Table structure for table `Order_List`
--
DROP TABLE IF EXISTS `Order_List`;
CREATE TABLE `Order_List` (
  `User_ID` int(11) NOT NULL COMMENT '會員ID',  
  `Number` int(10) NOT NULL auto_increment COMMENT '訂單號碼',
  `Status` varchar(10) NOT NULL DEFAULT '' COMMENT '訂單狀態',
  `Date` DATE NOT NULL COMMENT '下單日期',
  `Cost` int(6) COMMENT '訂單總額',
  FOREIGN KEY (`User_ID`) references UserAccount(`ID`) on delete cascade on update cascade,
  PRIMARY KEY (`Number`)
) COMMENT '訂單';
ALTER TABLE `Order_List` AUTO_INCREMENT=3005201;

--
-- Table structure for table `Order_Item`
--
DROP TABLE IF EXISTS `Order_Item`;
CREATE TABLE `Order_Item` (
  `Order_Number` int(11) NOT NULL COMMENT '訂單號碼',
  `Book_ID` int(11) NOT NULL COMMENT '書籍ID',
  `Quantity` int(3) COMMENT '數量',
  `Cost` int(6) COMMENT '商品總額',
  FOREIGN KEY (`Order_Number`) references Order_List(`Number`) on delete cascade on update cascade
) COMMENT '訂單書籍內容';

--
-- Table structure for table `Cart`
--
DROP TABLE IF EXISTS `Shopping_Cart`;
CREATE TABLE `Shopping_Cart` (
  `User_ID` int(11) NOT NULL COMMENT '會員ID',
  `Book_ID` int(11) NOT NULL COMMENT '書籍ID',
  `Quantity` int(3) NOT NULL COMMENT '數量',
  PRIMARY KEY (`User_ID`,`Book_ID`),
  FOREIGN KEY (`User_ID`) references UserAccount(`ID`) on delete cascade on update cascade,
  FOREIGN KEY (`Book_ID`) references Book(`ID`) on delete cascade on update cascade
) COMMENT '購物車';

--
-- Table structure for table `TrackingList`
--
DROP TABLE IF EXISTS `Tracking_List`;
CREATE TABLE `Tracking_List` (
  `User_ID` int(11) NOT NULL COMMENT '會員ID',
  `Book_ID` int(11) NOT NULL COMMENT '書籍ID',
  PRIMARY KEY (`User_ID`,`Book_ID`),
  FOREIGN KEY (`User_ID`) references UserAccount(`ID`) on delete cascade on update cascade,
  FOREIGN KEY (`Book_ID`) references Book(`ID`) on delete cascade on update cascade
) COMMENT '追蹤清單';

--
-- Table structure for MultiValue attribute `BookCategory`
--
DROP TABLE IF EXISTS `Category`;
CREATE TABLE `Category` (
  `Book_ID` int(11) NOT NULL COMMENT '書籍ID' ,
  `Language` varchar(10) default'English' COMMENT '語言',
  `Type` varchar(15) COMMENT '類別',
  `Image_Path` varchar(100) NOT NULL COMMENT '圖片路徑',
  `IsEBook` bool COMMENT '是否為電子書',
  FOREIGN KEY (`Book_ID`) references Book(`ID`) on delete cascade on update cascade,
  PRIMARY KEY (`Book_ID`,`Language`,`Type`)
) COMMENT '書籍分類';

--
-- test_case
--
INSERT INTO `UserAccount` VALUES (1001,'test','test','0932388469', '1998-01-01', '300 test Rd.', 'test@gmail.com');
INSERT INTO `UserAccount` VALUES (1002,'henry','12345678','0932388469', '1997-01-01', '224 JianGuo Rd.', 'henry006@gmail.com');
INSERT INTO `UserAccount` VALUES (1003,'justin','12345678','0912345678', '1998-07-05', '358 FuXing Rd.', 'justin25@gmail.com');

INSERT INTO `Clerk` VALUES (5001,'admin','admin');

INSERT INTO `Book` VALUES (2001,'9789571380056','和動物生活的四季','2017-05-05',514,'時報出版','bookJared Diamond',15,'images/Nature_001.jpg','當代動物行為學世界權威、諾貝爾獎得主康拉德・勞倫茲從青年研究者時期就對灰雁特別感興趣。他之所以選擇灰雁展開如此漫長的動物行為研究，是因為「灰雁從家庭到群體生活都和人類有著極為相似之處」。');
INSERT INTO `Book` VALUES (2002,'9789864304257','親子自然科學大百科','2018-08-01',494,'新文京','戴江淮',20,'images/Nature_002.jpg','孩子是天生的自然科學家，走在路上可能會蹲下來觀察螞蟻，吃飯吃到一半會覺得湯匙裡反射的自己很神奇，這樣的好奇心連結著疑問，而疑問自然從觀察開始；但是，孩子現在面對的不只是自然現象，還有日新月異的資訊科技，小孩需要的是與過去不一樣的自然科學素養。');
INSERT INTO `Book` VALUES (2003,'9781556224324','雜食者的兩難（新版）','2015-06-25',558,'Natl Book Network','Braden, Richard P.',12,'images/Nature_003.jpg','深度的調查報導，是趣味的科普作品，更是優美的自然文學。越了解飲食，才能越享受飲食。解開雜食者的兩難，從目擊真相，重新思考人類與自然的關係開始。');
INSERT INTO `Book` VALUES (2004,'9789865023058','Design For Motion','2019-10-31',458,'碁峰','邱勇標',33,'images/Art_001.jpg','Visionary designer and technologist John Maeda defines the fundamental laws of how computers think, and why you should care even if you are not a programmer.');
INSERT INTO `Book` VALUES (2005,'9781108459020','Uptrend/V-plus','2019-11-01',1500,'Cambridge University Press','Abbott, Ryan',6,'images/Art_002.jpg','UPTREND手工縫製商品 UPTREND所有布製商品皆為MIT設計製造，車縫師裁剪、車縫、整燙。 專業並且細心的製造+包裝方能出貨。希望每個商品都能夠更加豐富使用者的LIFE STYLE 。');
INSERT INTO `Book` VALUES (2006,'9789869690461','設計幀理：裝幀的藝術','2019-11-30',394,'不求人文化','SendPoints',12,'images/Art_003.jpg','不管你是出版產業的設計人員、在家接案的封面設計師、每天要提出創新想法的行銷人員、開發產品的企劃人員、想賺大錢的電商……等，只要你的產品與包裝有關，與人有關，《設計幀理：裝幀的藝術》就是你的設計寶典！');
INSERT INTO `Book` VALUES (2007,'9780014590467','哈佛商業評論全球中文版','2018-10-17',500,'遠見天下','季原',50,'images/Business_001.jpg','當協作成為企業日常 當今的商業環境中，破壞性的改變已成為常態，組織要因應變局，必須建立起許多不同於以往的能力。 「協同合作」便是現代企業解決複雜問題的一項重要能力。');
INSERT INTO `Book` VALUES (2008,'9782233459020','為什麼你的退休金只有別人的一半？','2019-05-01',669,'商業周刊','闕又上',44,'images/Business_002.jpg','學習投資理財，有如習武，而武學的三個層次：「見自己」、「見天地」、「見眾生」，在此書昭然若揭，其剖析內容對台灣投資人的嘉惠將既深且廣。此書誠屬我今年所閱覽過的書籍中，最推薦給所有台灣人的一本投資理財大作！');
INSERT INTO `Book` VALUES (2009,'9781234567890','FinTech金融科技聖經','2018-04-10',549,'商業周刊','蘇珊',33,'images/Business_003.jpg','金融科技圈兩位FinTech先驅徵求全球86位專業從業者協力完成。前所未有， FinTech最重要71主題全包，共從理解現象到預測未來，一本即能掌握。');
INSERT INTO `Book` VALUES (2010,'9785678941301','Simply Real Eating','2019-12-01',499,'Countryman Press','Adler, Sarah',10,'images/Life_001.jpg','Simply Real Eating: Everyday Recipes and Rituals for a Healthy Life Made Simple');
INSERT INTO `Book` VALUES (2011,'9785564665441','How to Be Well: The 6 Keys to a Happy and Healthy Life','2019-12-07',1400,'Highbridge Co','Lipman, Frank, M.D.',12,'images/Life_002.jpg','master the building blocks of life – food – a source of healing and flavor-filled enjoyment');
INSERT INTO `Book` VALUES (2012,'9785544651112','Surviving Cancer','2019-10-22',888,'New Insights Pr','Poothullil, John M., M.D.',66,'images/Life_003.jpg','Surviving cancer is anything but easy. Doing it once may be the toughest thing you ever do. For those who’ve done it more than once, you know firsthand that it never gets easier. That’s because every cancer diagnosis is unique in its challenges.');
INSERT INTO `Book` VALUES (2013,'9785564846652','正念飲食','2018-10-22',369,'時報出版 ','Jan Chozen Bays',10,'images/Food_001.jpg','吃是我們人一生當中最愉快的經驗之一。然而對某些人來說，它卻成了痛苦的源頭。當大家得知我正在寫《正念飲食》這本書時，便經常有人向我坦承自己患有進食障礙，從「我一焦慮就想吃東西」到「我得暴食症已經十年了」，一直到「我一坐下來吃東西，內心就升起恐慌」不等。');
INSERT INTO `Book` VALUES (2014,'9785623533111','Allen Carr’s Easy Way to Quit Emotional Eating','2017-02-20',269,'Arcturus Publishing','Carr,Allen,Dicey,John',20,'images/Food_002.jpg','The Easyway method has now been applied to the problem of emotional eating. With Allen Carr Easyway method, you can eat as much of your favorite foods as you want, whenever you want, as often as you want.');
INSERT INTO `Book` VALUES (2015,'9787855111206','Famished','2019-06-01',479,'Univ of California Pr ','Lester, Rebecca J.',23,'images/Food_003.jpg','Did you just order a double cheeseburger with large fries and a liter-sized milkshake? Either you have a death wish or you are extremely hungry — famished that is.');
INSERT INTO `Book` VALUES (2016,'9781400069996','Save Me the Plums: My Gourmet Memoir','2019-04-02',463,'Random House','Ruth Reichl',35,'images/Food_004.jpg',' Trailblazing food writer and beloved restaurant critic Ruth Reichl took the job (and the risk) of a lifetime when she entered the high-stakes world of magazine publishing. Now, for the first time, she chronicles her groundbreaking tenure as editor in chief of Gourmet.');
INSERT INTO `Book` VALUES (2017,'9781945256974','Bowls: Vibrant Recipes with Endless Possibilities','2019-12-17',584,'America\'s Test Kitchen','America\'s Test Kitchen',325,'images/Food_005.jpg','Want to cook healthier low-stress dinners, improve your lunch game, and find meals that can be prepped mostly in advance? Bowls are for you! The beauty of building a meal in a bowl is its versatility.');
INSERT INTO `Book` VALUES (2018,'9789579542869','製造文明','2019-12-04',435,'大家出版','宋宜真',8,'images/Nature_004.jpg','這本圖冊收錄了再造人類文明所必要的重要知識，橫跨現代各大重要基礎學門，包括語言、數學、地科、農業、生科、營養、物理化學、機械、建築、哲學、美術、音樂、醫療、機電等等，還有各種論據、圖表和偉大名言，即使是最毫無頭緒的時空旅人，都能就地創建一個燦爛文明。');
INSERT INTO `Book` VALUES (2019,'9789578567412','敘事本能：為什麼大腦愛編故事','2019-12-01',463,'如果出版社','管中琪',21,'images/Nature_005.jpg','書中從敘事本能的起源談起，列舉猿猴行為研究、坦桑尼亞原住民活動、人類愛揣測的習性、長襪皮皮、諾亞方舟，以至近代紐約世貿911的世紀災難等無數例子。');
INSERT INTO `Book` VALUES (2020,'9789864777662','反市場：JG股市操作原理','2019-12-12',332,'商周出版','JG',23,'images/Business_004.jpg','股市是世界上最公平的戰場，但在股市裡，標準答案通常是最危險的毒。ＪＧ老師曾說：「股市有一百種人，就有一百種賺錢方式。」你會在本書學到「反市場」這個觀念來重新看待股市，改善與強化個人的交易系統（SOP），當你看到更大、更新的不一樣視野後，就會在股市找到脫離現狀的方法！');
INSERT INTO `Book` VALUES (2021,'9789864777495','頂尖外商顧問的超效問題解決術','2019-04-02',260,'商周出版','簡琪婷',63,'images/Business_005.jpg','職場菜鳥及中堅幹部都該看。從困局到勝局！克服無理要求，才能從平庸進化為頂尖！挑戰目前實力無法應付，必須「強自己所難」的無理要求，才能以最少時間創造最大價值。');
INSERT INTO `Book` VALUES (2022,'9781607747307','The Life-Changing Magic of Tidying Up','2014-10-12',275,'Ten Speed Press','Marie Kondo',129,'images/Life_004.jpg','Despite constant efforts to declutter your home, do papers still accumulate like snowdrifts and clothes pile up like a tangled mess of noodles? Japanese cleaning consultant Marie Kondo takes tidying to a whole new level.');
INSERT INTO `Book` VALUES (2023,'9781501157165','A Beginner\'s Guide to the End','2019-04-02',500,'Simon & Schuster','BJ Miller, Shoshana Berger',60,'images/Life_005.jpg','“A gentle, knowledgeable guide to a fate we all share” (The Washington Post): the first and only all-encompassing action plan for the end of life.');
INSERT INTO `Book` VALUES (2024,'9789861202365','觀看的方式','2010-08-05',190,'麥田 ','吳莉君',235,'images/Art_004.jpg','探究我們如何觀看藝術和世界的方式，最精練又最具衝擊性的經典視覺藝術之作。觀看先於言語。孩童先會觀看和辨識，接著才會說話。不過觀看先於言語還有另一種義涵。藉由觀看，我們確定自己置身於周遭世界當中；我們用言語解釋這個世界。');
INSERT INTO `Book` VALUES (2025,'9789864592159','色彩互動學（50週年暢銷紀念版）','2019-12-26',585,'積木','劉怡伶',883,'images/Art_005.jpg','遵循花招百出的藝術家亞伯斯所訂下的高標準，耶魯大學出版社在1963年大膽地出版了《色彩互動學》。書一出版，幾乎隨即開始改變全世界讀者對於觀看這件事的認知。亞伯斯用革命性的手法強調實驗的重要，質疑強調品味的傳統觀念；他要觀者主動參與其中，而非只是被動接收訊息。');

INSERT INTO `Category` VALUES (2001,'中文書','自然科普','images/Nature/Nature_001.jpg',false);
INSERT INTO `Category` VALUES (2002,'中文書','自然科普','images/Nature/Nature_002.jpg',false);
INSERT INTO `Category` VALUES (2003,'中文書','自然科普','images/Nature/Nature_003.jpg',false);
INSERT INTO `Category` VALUES (2004,'原文書','藝術設計','images/Art/Art_001.jpg',false);
INSERT INTO `Category` VALUES (2005,'原文書','藝術設計','images/Art/Art_002.jpg',false);
INSERT INTO `Category` VALUES (2006,'中文書','藝術設計','images/Art/Art_003.jpg',false);
INSERT INTO `Category` VALUES (2007,'中文書','商業理財','images/Business/Business_001.jpg',false);
INSERT INTO `Category` VALUES (2008,'中文書','商業理財','images/Business/Business_002.jpg',false);
INSERT INTO `Category` VALUES (2009,'原文書','商業理財','images/Business/Business_003.jpg',false);
INSERT INTO `Category` VALUES (2010,'原文書','生活風格','images/Life/Life_001.jpg',false);
INSERT INTO `Category` VALUES (2011,'原文書','生活風格','images/Life/Life_002.jpg',false);
INSERT INTO `Category` VALUES (2012,'原文書','生活風格','images/Life/Life_003.jpg',false);
INSERT INTO `Category` VALUES (2013,'中文書','飲食','images/Food/Food_001.jpg',false);
INSERT INTO `Category` VALUES (2014,'原文書','飲食','images/Food/Food_002.jpg',false);
INSERT INTO `Category` VALUES (2015,'原文書','飲食','images/Food/Food_003.jpg',false);
INSERT INTO `Category` VALUES (2016,'原文書','飲食','images/Food/Food_004.jpg',false);
INSERT INTO `Category` VALUES (2017,'原文書','飲食','images/Food/Food_005.jpg',false);
INSERT INTO `Category` VALUES (2018,'中文書','自然科普','images/Nature/Nature_004.jpg',false);
INSERT INTO `Category` VALUES (2019,'中文書','自然科普','images/Nature/Nature_005.jpg',false);
INSERT INTO `Category` VALUES (2020,'中文書','商業理財','images/Business/Business_004.jpg',false);
INSERT INTO `Category` VALUES (2021,'中文書','商業理財','images/Business/Business_005.jpg',false);
INSERT INTO `Category` VALUES (2022,'原文書','生活風格','images/Life/Life_004.jpg',false);
INSERT INTO `Category` VALUES (2023,'原文書','生活風格','images/Life/Life_005.jpg',false);
INSERT INTO `Category` VALUES (2024,'中文書','藝術設計','images/Art/Art_004.jpg',false);
INSERT INTO `Category` VALUES (2025,'中文書','藝術設計','images/Art/Art_005.jpg',false);

INSERT INTO `Order_List` VALUES (1001,3005201,'準備出貨','2019-12-12',2402);
INSERT INTO `Order_List` VALUES (1002,3005202,'已到貨','2019-11-20',4564);
INSERT INTO `Order_List` VALUES (1003,3005203,'送貨中','2019-12-20',14335);


INSERT INTO `Order_Item` VALUES (3005201,2001,2,1028);
INSERT INTO `Order_Item` VALUES (3005201,2004,3,1374);
INSERT INTO `Order_Item` VALUES (3005202,2001,5,2570);
INSERT INTO `Order_Item` VALUES (3005202,2002,1,494);
INSERT INTO `Order_Item` VALUES (3005202,2005,1,1500);
INSERT INTO `Order_Item` VALUES (3005203,2012,3,2664);
INSERT INTO `Order_Item` VALUES (3005203,2009,10,5490);
INSERT INTO `Order_Item` VALUES (3005203,2015,8,3832);
INSERT INTO `Order_Item` VALUES (3005203,2023,4,2000);
INSERT INTO `Order_Item` VALUES (3005203,2013,1,369);

INSERT INTO `Shopping_Cart` VALUES (1001,2001,3);
INSERT INTO `Shopping_Cart` VALUES (1001,2003,2);
INSERT INTO `Shopping_Cart` VALUES (1002,2005,5);
INSERT INTO `Shopping_Cart` VALUES (1003,2015,6);
INSERT INTO `Shopping_Cart` VALUES (1003,2006,4);
INSERT INTO `Shopping_Cart` VALUES (1003,2014,10);

INSERT INTO `Tracking_List` VALUES (1001,2002);
INSERT INTO `Tracking_List` VALUES (1001,2004);
INSERT INTO `Tracking_List` VALUES (1002,2001);
INSERT INTO `Tracking_List` VALUES (1002,2002);
INSERT INTO `Tracking_List` VALUES (1003,2006);
INSERT INTO `Tracking_List` VALUES (1003,2008);
INSERT INTO `Tracking_List` VALUES (1003,2009);
INSERT INTO `Tracking_List` VALUES (1003,2014);


