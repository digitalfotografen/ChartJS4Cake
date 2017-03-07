<?php
namespace ChartJS\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use ChartJS\View\Helper\ChartJSHelper;

/**
 * ChartJS\View\Helper\ChartJSHelper Test Case
 */
class ChartJSHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ChartJS\View\Helper\ChartJSHelper
     */
    public $ChartJS;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->ChartJS = new ChartJSHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChartJS);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
