<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace AlbumTest\Model\Album;

use Album\Model\Album\AlbumEntity;
use PHPUnit\Framework\TestCase;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

/**
 * Class AlbumRepositoryTest
 * @package AlbumTest\Model\Album
 */
class AlbumRepositoryTest extends TestCase
{
    /** @var array $data */
    protected $data = [
        'id' => 123,
        'artist' => 'The Prodigy',
        'title' => 'Experience',
    ];

    /**
     * @return AlbumEntity
     */
    public function testInstance()
    {
        $album = new AlbumEntity;
        $this->assertInstanceOf(AlbumEntity::class, $album);
        return $album;
    }

    /**
     * @depends testInstance
     * @param $album
     *
     * @param $album
     */
    public function testInitialAlbumsValuesAreNull(\ArrayObject $album)
    {
        $this->assertFalse(isset($album['id']), '"id" should be NULL on default');
        $this->assertFalse(isset($album['artist']), '"artist" should be NULL on default');
        $this->assertFalse(isset($album['title']), '"title" should be NULL on default');
    }

    /**
     * @depends testInstance
     * @param $album
     *
     * @param \ArrayObject $album
     */
    public function testExchangeArraySetPropertiesCorrectly(\ArrayObject $album)
    {
        $album->exchangeArray($this->data);

        $this->assertSame($album['id'], $this->data['id'], '"id" was not set correctly');
        $this->assertSame($album['artist'], $this->data['artist'], '"artist" was not set correctly');
        $this->assertSame($album['title'], $this->data['title'], '"title" was not set correctly');

        return $album;
    }

    /**
     * @depends testExchangeArraySetPropertiesCorrectly
     * @param $album
     *
     * @param \ArrayObject $album
     */
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent(\ArrayObject $album)
    {
        $album->exchangeArray([]);

        $this->assertFalse(isset($album['id']), '"id" should be NULL on default');
        $this->assertFalse(isset($album['artist']), '"artist" should be NULL on default');
        $this->assertFalse(isset($album['title']), '"title" should be NULL on default');
    }

    /**
     * @depends testExchangeArraySetPropertiesCorrectly
     * @param $album
     *
     * @param \ArrayObject $album
     */
    public function testGetArrayCopyReturnsAnArrayWithPropertyValues(\ArrayObject $album)
    {
        $album->exchangeArray($this->data);
        $data = $album->getArrayCopy();

        $this->assertSame($album['id'], $data['id'], '"id" was not set correctly');
        $this->assertSame($album['artist'], $data['artist'], '"artist" was not set correctly');
        $this->assertSame($album['title'], $data['title'], '"title" was not set correctly');
    }

    /**
     * @depends testExchangeArraySetPropertiesCorrectly
     * @param $album
     *
     * @param \ArrayObject $album
     */
    public function testInputFiltersAreSetCorrectly(\ArrayObject $album)
    {
        /** @var InputFilterInterface $inputFilter */
        $inputFilter = $album->getInputFilter();

        $this->assertEquals(3, $inputFilter->count());
        $this->assertTrue($inputFilter->has('id'));
        $this->assertTrue($inputFilter->has('artist'));
        $this->assertTrue($inputFilter->has('title'));
    }

    /**
     * @depends testInstance
     * @param $album
     * @expectedException \DomainException
     *
     * @param \ArrayObject $album
     */
    public function testSetInputFilterTrowsCorrectException(\ArrayObject $album)
    {
        //try {
        //    $album->setInputFilter(new InputFilter);
        //} catch (\Exception $e) {
        //    $this->assertInstanceOf(\DomainException::class, $e);
        //}

        $this->setExpectedExceptionFromAnnotation();
        $album->setInputFilter(new InputFilter);
    }
}
