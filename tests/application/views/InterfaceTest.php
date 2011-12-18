<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://test.dev/");
  }

  public function testMyTestCase()
  {
        $this->open("/advanced_php_testing/mvc/");
        $this->type("id=new-todo", "Task 1");
        $this->keyPress("id=new-todo", "13");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isTextPresent(""));
        $this->type("id=new-todo", "Task 2");
        $this->keyPress("id=new-todo", "13");
        $this->waitForPageToLoad("30000");
        $this->assertTrue($this->isTextPresent(""));
  }
}
?>