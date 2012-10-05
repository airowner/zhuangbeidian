<?php
App::uses('ItemRecommend', 'Model');

/**
 * ItemRecommend Test Case
 *
 */
class ItemRecommendTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_recommend',
		'app.item',
		'app.tag',
		'app.item_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemRecommend = ClassRegistry::init('ItemRecommend');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemRecommend);

		parent::tearDown();
	}

}
