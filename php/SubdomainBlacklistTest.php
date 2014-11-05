<?php
namespace MD\SubdomainBlacklist;

use MD\SubdomainBlacklist\SubdomainBlacklist;

/**
 * @coversDefaultClass \MD\SubdomainBlacklist\SubdomainBlacklist
 */
class SubdomainBlacklistTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers ::getList
     */
    public function testGetList() {
        $subdomainBlacklist = new SubdomainBlacklist();
        $blacklist = $subdomainBlacklist->getList();

        $this->assertInternalType('array', $blacklist, 
                'Failed asserting that ::getList() returns an array.');
        $this->assertNotEmpty($blacklist,
            'Failed asserting that ::getList() loads data.');

        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'blacklist.txt';
        $list = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $this->assertEquals($blacklist, $list,
            'Failed asserting that blacklist.txt file was loaded.');
    }

    /**
     * @covers ::addToList
     * @covers ::normalize
     */
    public function testAddStringToList() {
        $subdomainBlacklist = new SubdomainBlacklist();

        $add = 'frodo';
        $this->assertNotContains($add, $subdomainBlacklist->getList(),
            'Failed asserting that string we are testing is not in the default blacklist.');

        $subdomainBlacklist->addToList($add);

        $this->assertContains($add, $subdomainBlacklist->getList(),
            'Failed asserting that string was added to the blacklist.');
    }

    /**
     * @covers ::addToList
     * @covers ::normalize
     */
    public function testAddArrayToList() {
        $subdomainBlacklist = new SubdomainBlacklist();

        $add = array(
            'frodo',
            'sam',
            'merry',
            'pippin'
        );
        foreach($add as $item) {
            $this->assertNotContains($item, $subdomainBlacklist->getList(),
                'Failed asserting that default blacklist doesn\'t contain a test string.');
        }

        $subdomainBlacklist->addToList($add);

        foreach($add as $item) {
            $this->assertContains($item, $subdomainBlacklist->getList(),
                'Failed asserting that string from array was added to the blacklist.');
        }
    }

    /**
     * @covers ::addToList
     * @covers ::normalize
     */
    public function testAddToListNormalize() {
        $subdomainBlacklist = new SubdomainBlacklist();

        $add = array(
            'frodo18',
            'sams',
            'MeRRy',
            'Pippin83s'
        );
        foreach($add as $item) {
            $this->assertNotContains($item, $subdomainBlacklist->getList(),
                'Failed asserting that default blacklist doesn\'t contain a test string.');
        }

        $normalized = array(
            'frodo',
            'sam',
            'merry',
            'pippin'
        );
        foreach($normalized as $item) {
            $this->assertNotContains($item, $subdomainBlacklist->getList(),
                'Failed asserting that default blacklist doesn\'t contain a normalized test string.');
        }

        $subdomainBlacklist->addToList($add);

        foreach($add as $item) {
            $this->assertNotContains($item, $subdomainBlacklist->getList(),
                'Failed asserting that not-normalized string was added to the blacklist.');
        }

        foreach($normalized as $item) {
            $this->assertContains('frodo', $subdomainBlacklist->getList(),
                'Failed asserting that normalized string was added to the blacklist.');
        }
    }

    /**
     * @covers ::validate
     * @covers ::normalize
     * @dataProvider provideStringsToTest
     */
    public function testValidate($string, $valid) {
        $subdomainBlacklist = new SubdomainBlacklist();
        $this->assertEquals($valid, $subdomainBlacklist->validate($string),
            'Failed asserting that a string has been properly validated.');

        // check alternative versions
        $this->assertEquals($valid, $subdomainBlacklist->validate(strtoupper($string)),
            'Failed asserting that an uppercase string has been properly validated.');

        $this->assertEquals($valid, $subdomainBlacklist->validate($string .'s'),
            'Failed asserting that a plural string has been properly validated.');

        $this->assertEquals($valid, $subdomainBlacklist->validate($string .'1'),
            'Failed asserting that a string with digit suffix has been properly validated.');
    }

    public function provideStringsToTest() {
        // load the original blacklist to make sure everything has been added
        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'blacklist.txt';
        $list = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // so far everything is invalid
        $strings = array_map(function($string) {
            return array($string, false);
        }, $list);

        // but also add few valid strings
        $strings[] = array('frodo', true);
        $strings[] = array('Sam23', true);
        $strings[] = array('mErrYs', true);
        $strings[] = array('PippINs', true);

        return $strings;
    }

}