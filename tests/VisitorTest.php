<?php

class VisitorTest extends TestCase {

    public function testValidateReturnsFalseIfVisitorNameIsMissing()
    {
        $validation = \App\Models\Visitor::validate([]);
        $this->assertEquals($validation->passes(), false);
    }

    public function testValidateReturnsTrueIfVisitorNameIsPresent()
    {
        $validation = \App\Models\Visitor::validate([
            'name' => 'visitor'
        ]);
        $this->assertEquals($validation->passes(), true);
    }
}