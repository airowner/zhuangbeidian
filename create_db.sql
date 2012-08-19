
CREATE TABLE `item`
(
    `id` int(11) not null auto_increament,
    `num_iid` int(11) not null comment 'taobao详情页 item.htm 对应id item.htm?id=xxx',
    `track_iid` int(11) not null,
    `cid` int(11) not null comment '分类id?',
    `list_time` datetime not null comment '上架时间',
    `modified` datetime not null comment '最后修改时间',
    `delist_time` datetime not null comment '下架时间',
    `title` varchar(255) not null comment '商品名称',
    `pic_url` varchar(255) not null comment '商品图片url',
    `price` decimal(2) not null comment '商品费用',
    `props` varchar(255) not null comment '宝贝详情属性部分',
    `property_alias`
    `outer_id`
    `nick` varchar(255) not null comment 'taobao帐号',
    `city` varchar(255) not null comment '城市',
    `state` varchar(255) not null comment '省份？',
    `desc` text not null comment '宝贝描述',
    `auction_point` not null,
    `approve_status` not null,
    `detail_url` varchar(255) not null comment '商品taobao地址',
    `ems_fee` decimal(2) not null comment 'ems费用',
    `express_fee` decimal(2) not null comment '快递费用',
    `freight_payer` decimal(2) not null comment 'ems费用',
    `has_discount`
    `has_invoice`
    `has_showcase`
    `has_warranty`
    `input_pids`
    `input_str`
    `is_virtual`
    `seller_cids`
    `stuff_status`
    `type`
    `valid_thru`
    `post_fee`
    `postage_id`
) ENGINE=innodb charset=utf8;


CREATE TABLE `tag`
(
    `id` int(11) not null auto_increament,
    `tag` varchar(255) not null,
    `pid` int(11) not null default 0,
    `validate` tinyint(3) not null default 1,
    PRIMARY KEY `id` (`id`)
) ENGINE=innodb charset=utf8;


CREATE TABLE `item_tag`
(
    `id` int(11) not null auto_increament,
    `tagid` varchar(255) not null,
    `itemid` int(11) not null,
    PRIMARY KEY `id` (`id`)
) ENGINE=innodb charset=utf8;
