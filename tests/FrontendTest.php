<?php
class FrontendTest extends PHPUnit_Framework_TestCase {

  use WebDriverAssertions;
  use WebDriverDevelop;

  protected $url = 'http://localhost/etc';
  /**
   * @var \RemoteWebDriver
   */
  protected $webDriver;

  // Politely taken from https://gist.github.com/luxcem/8240758
  public function waitForAjax($timeout = 5, $interval = 200)
  {
    $this->webDriver->wait($timeout, $interval)->until(function() {
        // jQuery: "jQuery.active" or $.active
        $condition = 'return ($.active == 0);';
        return $this->webDriver->executeScript($condition);
    });
  }

	public function setUp()
  {
      $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox');
      $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
  }

  public function tearDown()
  {
      $this->webDriver->quit();
  }

  public function testTitle()
  {
    $this->webDriver->get($this->url);
    // checking that page title contains word 'GitHub'
    $this->assertContains('Cheap calls', $this->webDriver->getTitle());
  }

  public function testSearch()
  {
      $this->webDriver->get($this->url);

      $search = $this->webDriver->findElement(WebDriverBy::id('number'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys('467811111');
      $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
      $this->waitForAjax();
      $result = $this->webDriver->findElement(WebDriverBy::id('result'));
      $text = $result->getText();
      $this->assertContains("Best operator is A", $text);

      $this->webDriver->navigate()->refresh();
      $search = $this->webDriver->findElement(WebDriverBy::id('number'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys('foobar');
      $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
      $this->waitForAjax();
      $result = $this->webDriver->findElement(WebDriverBy::id('result'));
      $text = $result->getText();
      $this->assertContains("Supply a number", $text);

      $this->webDriver->navigate()->refresh();
      $search = $this->webDriver->findElement(WebDriverBy::id('number'));
      $search->click();
      $this->webDriver->getKeyboard()->sendKeys('777777777');
      $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
      $this->waitForAjax();
      $result = $this->webDriver->findElement(WebDriverBy::id('result'));
      $text = $result->getText();
      $this->assertContains("No operator found", $text);
  }
}
