

CREATE TABLE `news` (
   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
   `title` varchar(200) DEFAULT NULL COMMENT '新闻标题',
   `new_url` text COMMENT '新闻地址',
   `source` varchar(300) DEFAULT NULL COMMENT '新闻来源',
   `category` varchar(300) DEFAULT NULL COMMENT '新闻分类',
   `content` text COMMENT '新闻内容',
   `time` varchar(30) DEFAULT NULL COMMENT '发布时间',
   `enabled` tinyint(1) DEFAULT '1' COMMENT '是否可用1，可用0.不可用',
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=748 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='新闻表'


CREATE TABLE `news_url` (
   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
   `uri` text COMMENT '新闻抓取地址',
   `status` tinyint(1) DEFAULT '0' COMMENT '1.抓取完毕 0.未抓取',
   PRIMARY KEY (`id`),
   FULLTEXT KEY `url` (`uri`)
 ) ENGINE=MyISAM AUTO_INCREMENT=264 DEFAULT CHARSET=utf8


CREATE TABLE `url` (
   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
   `url` text CHARACTER SET latin1 COMMENT 'url',
   `type` varchar(30) CHARACTER SET latin1 DEFAULT NULL COMMENT '网址extend',
   `time` varchar(30) CHARACTER SET latin1 DEFAULT NULL COMMENT '创建时间',
   `status` tinyint(1) DEFAULT '0' COMMENT '是否已经爬取1，完成 0，未完成',
   PRIMARY KEY (`id`),
   FULLTEXT KEY `url` (`url`)
 ) ENGINE=MyISAM AUTO_INCREMENT=41232 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC

CREATE TABLE `extend` (
   `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
   `extend` varchar(100) DEFAULT NULL COMMENT '扩展名',
   `count` int(11) DEFAULT '0' COMMENT '出现次数',
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB AUTO_INCREMENT=71086 DEFAULT CHARSET=utf8