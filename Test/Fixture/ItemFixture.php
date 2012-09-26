<?php
/**
 * ItemFixture
 *
 */
class ItemFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'item';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'num_iid' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'comment' => 'taobao详情页 item.htm 对应id item.htm?id=xxx'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '商品名称', 'charset' => 'utf8'),
		'click_url' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '转换后的淘宝链接url', 'charset' => 'utf8'),
		'shop_click_url' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '店铺url', 'charset' => 'utf8'),
		'seller_credit_score' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'key' => 'index', 'comment' => '卖家信用等级'),
		'pic_url' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '商品图片url', 'charset' => 'utf8'),
		'item_imgs' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '需要序列化，为多个宝贝的图片', 'charset' => 'utf8'),
		'num' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '库存'),
		'track_iid' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'cid' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '分类id?'),
		'list_time' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '上架时间'),
		'delist_time' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '下架时间'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null, 'comment' => '最后修改时间'),
		'price' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'comment' => '商品费用'),
		'nick' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'taobao帐号', 'charset' => 'utf8'),
		'city' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '城市', 'charset' => 'utf8'),
		'state' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '省份？', 'charset' => 'utf8'),
		'desc' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '宝贝描述', 'charset' => 'utf8'),
		'prop_img' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '宝贝详情属性多图', 'charset' => 'utf8'),
		'props' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '宝贝详情属性部分', 'charset' => 'utf8'),
		'property_alias' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '属性别名', 'charset' => 'utf8'),
		'auction_point' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'comment' => '拍卖点？'),
		'approve_status' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '核准状态:在售?onsale', 'charset' => 'utf8'),
		'detail_url' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '商品taobao地址', 'charset' => 'utf8'),
		'ems_fee' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'comment' => 'ems费用'),
		'express_fee' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'comment' => '快递费用'),
		'freight_payer' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '邮费付款方seller, buyer', 'charset' => 'utf8'),
		'has_discount' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'comment' => '是否有折扣'),
		'has_invoice' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'comment' => '是否有发票'),
		'has_showcase' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'comment' => '是否有橱窗？？'),
		'has_warranty' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'comment' => '是否有担保'),
		'is_virtual' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'comment' => '是否是虚拟货物'),
		'stuff_status' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '新品？二手？。。。new?', 'charset' => 'utf8'),
		'seller_cids' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'input_pids' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '自定义属性名id', 'charset' => 'utf8'),
		'input_str' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '自定义属性值', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'valid_thru' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '有效时长 ７天'),
		'post_fee' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'comment' => '邮费'),
		'postage_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => '邮件id'),
		'outer_id' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'skus' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '类似套餐的商品选择', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'seller_credit_score' => array('column' => 'seller_credit_score', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'num_iid' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'click_url' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'shop_click_url' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'seller_credit_score' => 1,
			'pic_url' => 'Lorem ipsum dolor sit amet',
			'item_imgs' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'num' => 1,
			'track_iid' => 'Lorem ipsum dolor sit amet',
			'cid' => 1,
			'list_time' => '2012-09-27 00:44:22',
			'delist_time' => '2012-09-27 00:44:22',
			'modified' => '2012-09-27 00:44:22',
			'price' => 1,
			'nick' => 'Lorem ipsum dolor sit amet',
			'city' => 'Lorem ipsum dolor sit amet',
			'state' => 'Lorem ipsum dolor sit amet',
			'desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'prop_img' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'props' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'property_alias' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'auction_point' => 1,
			'approve_status' => 'Lorem ipsum dolor sit amet',
			'detail_url' => 'Lorem ipsum dolor sit amet',
			'ems_fee' => 1,
			'express_fee' => 1,
			'freight_payer' => 'Lorem ipsum dolor sit amet',
			'has_discount' => 1,
			'has_invoice' => 1,
			'has_showcase' => 1,
			'has_warranty' => 1,
			'is_virtual' => 1,
			'stuff_status' => 'Lorem ipsum dolor sit amet',
			'seller_cids' => 'Lorem ipsum dolor sit amet',
			'input_pids' => 'Lorem ipsum dolor sit amet',
			'input_str' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'valid_thru' => 1,
			'post_fee' => 1,
			'postage_id' => 1,
			'outer_id' => 'Lorem ipsum dolor sit amet',
			'skus' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
