<?php

namespace MakeEbook;

require_once dirname(__FILE__) . '/../makeEbookFile.class.php';

/**
 * Test class for makeEbookFile.
 * Generated by PHPUnit on 2011-05-19 at 17:20:27.
 */
class makeEbookFileTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var makeEbookFile
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {

        // url var 1 (chapter)
        $a    = 1;//9;

        // url var 2 (item)
        $b    = 2;

        $urls = array();

        for($i=1; $i<=$a; $i++) {
            for($j=1; $j<=$b; $j++) {
                $urls[] =  "http://progit.org/book/ch{$i}-{$j}.html";
            }
        }

        $this->object = new \MakeEbook\makeEbookFile($urls, 'makeEbook-test.html');
        $this->object->setHeader('header');
        $this->object->setContent('content');
        $this->object->setClear(array('id'=>'nav', 'class'=>'clearfix'));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * executing crawler / parser
     */
    public function testExec() {
        try {
            $this->object->exec();
        }
        catch(Exception $e) {
            $this->fail('Test Error (Exec) : ' . $e->getMessage());
        }
    }

    /**
     * output file 
     */
    public function testOutput() {
        
        try {
            $this->object->exec();
            $this->object->output();
        }
        catch(Exception $e) {
            $this->fail('Test Error (Output) : ' . $e->getMessage());
        }

        // verify if file was created
        $this->assertTrue(file_exists($this->object->getFilename()));

        // test if log is correctly
        $expected = 'Crawler / Parser executed.' . \PHP_EOL .
                    'Output Executed (MakeEbook\makeEbookFile).' . \PHP_EOL .
                    'File generated in ' . $this->object->getFilename();

        $actual   = implode(PHP_EOL, $this->object->getLog());

        $this->assertEquals($expected, $actual);
    }

}

?>
