<?php

declare(strict_types=1);

require_once 'helper/dbFormhandlerTestCase.php';


final class dbFormhandler_PassFieldTest extends dbFormhandlerTestCase
{
    public function test_insert_noValues(): void
    {
        $_POST['FormHandler_submit'] = "1";

        $form = new dbFormHandler();

        $this->assertTrue($form->insert);
        $this->assertFalse($form->edit);

        $this->setConnectedTable($form, "test");

        $form->passField("Your password", "pass", FH_PASSWORD);

         $e = $form->catchErrors();

         $expected  = "You did not enter a correct value for this field!";
         $this->assertStringContainsString($expected, $e['pass']);
    }
 
    public function test_insert(): void
    {
        $this->createMocksForTable();

        $_POST['FormHandler_submit'] = "1";
        $_POST['pass'] = "secret";
        $_POST['textNullable'] = "thetext";

        $form = new dbFormHandler();

        $this->assertTrue($form->insert);
        $this->assertFalse($form->edit);

        $this->setConnectedTable($form, "test");

        $form->passField("Your password", "pass", FH_PASSWORD);
        $form->textField("TextNullable", "textNullable");

        // only textfield, not passfield
        $this->getDatabaseMock()
                ->expects($this->once())
                ->query("INSERT INTO test (pass, textNullable) VALUES ( 'secret', 'thetext' );")
                ->willSetAffectedRows(1)
                ->willSetLastInsertId(4711);

        $this->setCallbackOnSaved($form);
        
        $r = $form->flush(true);

        $this->assertEmpty($r);
        $this->assertSavedId(4711);
        $this->assertSavedValue('secret', 'pass');
        $this->assertSavedValue('thetext', 'textNullable');

    }
    
    public function test_update_noValues(): void
    {
        $this->createMocksForTable();

        $_POST['FormHandler_submit'] = "1";
        $_GET['id'] = "4714";

        $form = new dbFormHandler();

        $this->assertFalse($form->insert);
        $this->assertTrue($form->edit);

        $this->getDatabaseMock()
                ->expects($this->exactly(1))
                ->query($this->matches("SELECT * FROM test WHERE id = '4714'"))
                ->willReturnResultSet([
                    ['id' => '4714', 'textNullable' => 'text'],
                ]);

        $this->setConnectedTable($form, "test");

        $form->passField("Your password", "pass", FH_PASSWORD);
        $form->textField("TextNullable", "textNullable");

        $this->getDatabaseMock()
                ->expects($this->once())
                ->query("UPDATE test SET textNullable = NULL WHERE id = '4714'");

        $this->setCallbackOnSaved($form);
        
        $r = $form->flush(true);

        $this->fail("forced failure: empty pass fails");

        $this->assertEquals("", $r);
        $this->assertSavedId(4714);
        $this->assertSavedValueEmtpy('textNullable');
    }
 
    public function test_update(): void
    {
        $this->createMocksForTable();

        $_POST['FormHandler_submit'] = "1";
        $_GET['id'] = "4715";
        $_POST['pass'] = "newpass";

        $form = new dbFormHandler();

        $this->assertFalse($form->insert);
        $this->assertTrue($form->edit);

        $this->getDatabaseMock()
                ->expects($this->exactly(1))
                ->query($this->matches("SELECT * FROM test WHERE id = '4715'"))
                ->willReturnResultSet([
                    ['id' => '4715', 'pass' => 'secret'],
                ]);

        $this->setConnectedTable($form, "test");

        $form->passField("Your password", "pass", FH_PASSWORD);

        $this->getDatabaseMock()
                ->expects($this->once())
                ->query("UPDATE test SET pass = 'newpass' WHERE id = '4715'")
                ->willSetLastInsertId(4715);

        $this->setCallbackOnSaved($form);
        
        $r = $form->flush(true);

        $this->assertEmpty($r);
        $this->assertSavedId(4715);
        $this->assertSavedValue("newpass", "pass");
    }
};
