<?php declare(strict_types=1);

require_once 'helper/FormhandlerTestCase.php';

final class ConstructorTest extends FormhandlerTestCase
{
    final protected function getFormhandlerType() : string
    {
        return "Formhandler";
    } 
  
    public function testStandardFormname_POST() : void
    {
        $form = new FormHandler();

        $this->assertEquals(FH_DEFAULT_FORM_NAME, $form->getFormName());
        $this->assertFalse($form->isPosted());

        $this->assertEquals(1, $form->getCurrentPage());
        $this->assertEquals(1, $form->getLastSubmittedPage());
        $this->assertEquals(1, $form->getPage());
        $this->assertEquals(FH_DEFAULT_LANGUAGE, $form->getLang());
        $this->assertEquals(FH_DEFAULT_LANGUAGE, $form->getLanguage());
        $this->assertEmpty($form->getJavascriptCode());
        $this->assertTrue($form->isCorrect());
        $this->assertFalse($form->isViewMode());

        $aExpected = [
            '<form id="' . FH_DEFAULT_FORM_NAME . '" method="post" action="',
            '<ins><input type="hidden" name="FormHandler_submit" id="FormHandler_submit" value="1" />',
            "</ins><table border='0' cellspacing='0' cellpadding='3' >",
            "<p><span style='font-family:tahoma;font-size:10px;color:#B5B5B5;font-weight:normal;'>This form is generated by </span><a href=\"http://www.formhandler.net\" ><span style=\"font-family:Tahoma;font-size:10px;color:#B5B5B5;\"><strong>FormHandler</strong></span></a></p>",
            ];
            $this->assertFormFlushContains($form, $aExpected);
       }

    public function testDeviantFormname_POST() : void
    {
        $form = new FormHandler("DeviantFormName");

        $this->assertEquals("DeviantFormName", $form->getFormName());

        $this->assertFormFlushContains($form, '<form id="DeviantFormName" method="post" action="');
    }

    public function testStandardFormname_POST_submit() : void
    {
        $_POST['FormHandler_submit'] = "1";

        $form = new FormHandler();

        $this->assertTrue($form->isPosted());
        $this->assertTrue($form->isCorrect());

        $this->assertEquals("", $form->flush(true));
    }

    public function testNoExpose() : void
    {
        define('FH_EXPOSE', false);

        $form = new FormHandler();

        $aExpected = [
            '<form id="' . FH_DEFAULT_FORM_NAME . '" method="post" action="',
            '<ins><input type="hidden" name="FormHandler_submit" id="FormHandler_submit" value="1" />',
            "</ins><table border='0' cellspacing='0' cellpadding='3' >"
        ];

        $html = $this->assertFormFlushContains($form, $aExpected);

        $this->assertStringNotContainsString("<p><span style='font-family:tahoma;font-size:10px;color:#B5B5B5;font-weight:normal;'>This form is generated by </span><a href=\"http://www.formhandler.net\" ><span style=\"font-family:Tahoma;font-size:10px;color:#B5B5B5;\"><strong>FormHandler</strong></span></a></p>", $html);
    }

    public function testTableWith100() : void
    {
        define('FH_DEFAULT_TABLE_WIDTH', 123);

        $form = new FormHandler();

        $this->assertFormFlushContains($form, "</ins><table border='0' cellspacing='0' cellpadding='3' width='123' >");
    }

    public function testTableBorder1() : void
    {
        define('FH_DEFAULT_TABLE_BORDER', 99);

        $form = new FormHandler();

        $this->assertFormFlushContains($form, "</ins><table border='99' cellspacing='0' cellpadding='3' >");
    }

    public function testTableCellspacing1() : void
    {
        define('FH_DEFAULT_TABLE_CELLSPACING', 99);

        $form = new FormHandler();

        $this->assertFormFlushContains($form, "</ins><table border='0' cellspacing='99' cellpadding='3' >");
    }

    public function testTableCellpadding1() : void
    {
        define('FH_DEFAULT_TABLE_CELLPADDING', 99);

        $form = new FormHandler();

        $this->assertFormFlushContains($form, "</ins><table border='0' cellspacing='0' cellpadding='99' >");
    }

    public function testNoField() : void
    {
        $form = new FormHandler();

        $this->expectError();
        $this->expectErrorMessage('Try to get the value of an unknown field "notexist"!');

        $form->getValue("notexist");
    }
}