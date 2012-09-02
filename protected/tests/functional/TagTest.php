<?php

class TagTest extends WebTestCase
{
	public $fixtures=array(
		'tags'=>'Tag',
	);

	public function testShow()
	{
		$this->open('?r=tag/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=tag/create');
	}

	public function testUpdate()
	{
		$this->open('?r=tag/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=tag/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=tag/index');
	}

	public function testAdmin()
	{
		$this->open('?r=tag/admin');
	}
}
