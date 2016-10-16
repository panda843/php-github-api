<?php

namespace Github\Tests\Api\Repository;

use Github\Tests\Api\TestCase;

class CardsTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetAllColumnCards()
    {
        $expectedValue = array(array('card1data'), array('card2data'));

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('/repos/KnpLabs/php-github-api/projects/columns/123/cards')
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->all('KnpLabs', 'php-github-api', 123));
    }

    /**
     * @test
     */
    public function shouldShowCard()
    {
        $expectedValue = array('card1');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('/repos/KnpLabs/php-github-api/projects/columns/cards/123')
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->show('KnpLabs', 'php-github-api', 123));
    }

    /**
     * @test
     */
    public function shouldCreateCard()
    {
        $expectedValue = array('card1data');
        $data = array('content_id' => '123', 'content_type' => 'Issue');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/repos/KnpLabs/php-github-api/projects/columns/1234/cards', $data)
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->create('KnpLabs', 'php-github-api', '1234', $data));
    }

    /**
     * @test
     */
    public function shouldUpdateCard()
    {
        $expectedValue = array('note1data');
        $data = array('note' => 'note test');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('patch')
            ->with('/repos/KnpLabs/php-github-api/projects/columns/cards/123', $data)
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->update('KnpLabs', 'php-github-api', 123, $data));
    }

    /**
     * @test
     */
    public function shouldRemoveCard()
    {
        $expectedValue = array('someOutput');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('delete')
            ->with('/repos/KnpLabs/php-github-api/projects/columns/cards/123')
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->deleteCard('KnpLabs', 'php-github-api', 123));
    }

    /**
     * @test
     * @expectedException \Github\Exception\MissingArgumentException
     */
    public function shouldNotMoveWithoutPosition()
    {
        $data = array();

        $api = $this->getApiMock();
        $api->expects($this->never())
            ->method('post');

        $api->move('KnpLabs', 'php-github-api', '123', $data);
    }

    /**
     * @test
     */
    public function shouldMoveCard()
    {
        $expectedValue = array('card1');
        $data = array('position' => 'top');

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/repos/KnpLabs/php-github-api/projects/columns/cards/123/moves')
            ->will($this->returnValue($expectedValue));

        $this->assertEquals($expectedValue, $api->move('KnpLabs', 'php-github-api', 123, $data));
    }

    protected function getApiClass()
    {
        return 'Github\Api\Repository\Cards';
    }
}
