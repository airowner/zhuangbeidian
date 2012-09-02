
set names utf8;

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`
(
    `id` int(11) unsigned not null auto_increment,
    `num_iid` int(11) unsigned not null comment 'taobao详情页 item.htm 对应id item.htm?id=xxx',
    `item_imgs` text not null comment '需要序列化，为宝贝的图片',
    `num` int(11) unsigned not null comment '库存',
    `track_iid` int(11) unsigned not null,
    `cid` int(11) unsigned not null comment '分类id?',
    `list_time` datetime not null comment '上架时间',
    `modified` datetime not null comment '最后修改时间',
    `delist_time` datetime not null comment '下架时间',
    `title` varchar(255) not null comment '商品名称',
    `pic_url` varchar(255) not null comment '商品图片url',
    `price` decimal(10,2) unsigned not null comment '商品费用',
    `props` varchar(255) not null comment '宝贝详情属性部分',
    `nick` varchar(255) not null comment 'taobao帐号',
    `city` varchar(255) not null comment '城市',
    `state` varchar(255) not null comment '省份？',
    `desc` text not null comment '宝贝描述',
    `auction_point` tinyint(3) unsigned not null comment '拍卖点？',
    `approve_status` varchar(255) not null comment '在售?onsale',
    `detail_url` varchar(255) not null comment '商品taobao地址',
    `ems_fee` decimal(10,2) unsigned not null comment 'ems费用',
    `express_fee` decimal(10,2) unsigned not null comment '快递费用',
    `freight_payer` varchar(255) not null comment '邮费付款方seller, buyer',
    `has_discount` tinyint(3) unsigned not null comment '是否有折扣',
    `has_invoice` tinyint(3) unsigned not null comment '是否有发票',
    `has_showcase` tinyint(3) unsigned not null comment '是否有橱窗？？',
    `has_warranty` tinyint(3) unsigned not null comment '是否有折扣',
    `is_virtual` tinyint(3) unsigned not null comment '是否是虚拟货物',
    `stuff_status` varchar(255) not null comment '新品？二手？。。。new?',
    `seller_cids` varchar(255) not null,
    `input_pids` varchar(255) not null comment '自定义属性名id',
    `input_str` varchar(255) not null comment '自定义属性值',
    `type` varchar(255) not null,
    `valid_thru` int(11) unsigned not null,
    `post_fee` decimal(10,2) unsigned not null,
    `postage_id` int(11) unsigned not null,
    `property_alias` varchar(255) not null,
    `outer_id` varchar(255) not null,
    `skus` text not null comment '商品分类',
    PRIMARY KEY `id` (`id`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag`
(
    `id` int(11) not null auto_increment,
    `tag` varchar(255) not null,
    `pid` int(11) not null default 0,
    `display_html` tinyint(1) not null default 0 comment '是否显示在页面分类中',
    `order` tinyint(3) not null default 0 comment '排序',
    `validate` tinyint(1) not null default 1,
    `time` timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY `id` (`id`),
    KEY `pid` (`pid`),
    UNIQUE KEY `tag` (`tag`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- game 游戏tag
-- official 官方tag （用于官方分类，搜索)
-- user 用户自定义tag (用户提交商品自定义tag， 如果不再收录的tag中， 则添加为此分类， 方便转入官方支持的tag）
insert into `tag` (`tag`, `pid`, `display_html`) value \

('#game', 0, 0), \
('#official', 0, 0), \
('#user', 0, 0), \

('服装', 2, 1), \
('配饰', 2, 1), \
('周边', 2, 1), \
('电子产品', 2, 1), \

('大衣', 4, 1), \
('卫衣', 4, 1), \
('T恤', 4, 1), \
('裤子', 4, 1), \
('鞋', 4, 1), \
('帽子', 4, 1), \


('手表', 5, 1), \
('钥匙链', 5, 1), \
('打火机', 5, 1), \
('烟灰缸', 5, 1), \
('项链', 5, 1), \
('徽章', 5, 1), \

('抱枕靠垫', 6, 1), \
('杯子', 6, 1), \
('手机壳', 6, 1), \
('其他', 6, 1), \

('耳机', 7, 1), \
('手柄', 7, 1), \
('U盘', 7, 1), \
('鼠标垫', 7, 1), \

('穿越火线', 1, 1), \
('英雄联盟', 1, 1), \
('梦幻西游', 1, 1), \
('地下城与勇士', 1, 1), \
('植物大战僵尸', 1, 1), \
('愤怒的小鸟', 1, 1);


DROP TABLE IF EXISTS `item_tag`;
CREATE TABLE `item_tag`
(
    `id` int(11) unsigned not null auto_increment,
    `itemid` int(11) unsigned not null,
    `tagid` int(11) unsigned not null,
    PRIMARY KEY `id` (`id`),
    KEY `tagid` (`tagid`),
    KEY `itemid` (`itemid`)
) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


--请求列表
--DROP TABLE IF EXISTS `item_get_before`;
--CREATE TABLE `item_tag`
--(
--    `id` int(11) unsigned not null auto_increment,
--    `url` varchar(255) not null comment 'http://xx.taobao.com/item?mid=xxxxx',
--    `tags` varchar(255) not null,
--    PRIMARY KEY `id` (`id`),
--) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


--热门店铺
--DROP TABLE IF EXISTS `shop`;
--CREATE TABLE `shop`
--(
--    `id` int(11) unsigned not null auto_increment,
--    `name` varchar(255) not null,
--    PRIMARY KEY `id` (`id`),
--) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
--
--DROP TABLE IF EXISTS `shop_tag`;
--CREATE TABLE `shop_tag`
--(
--    `id` int(11) unsigned not null auto_increment,
--    `shopid` int(11) unsigned not null comment 'http://xx.taobao.com/item?mid=xxxxx',
--    `tags` varchar(255) unsigned not null,
--    PRIMARY KEY `id` (`id`),
--    KEY `tagid` (`tagid`),
--    KEY `itemid` (`itemid`)
--) ENGINE=innodb DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
--
