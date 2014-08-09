<?php
namespace Tests\Formular\Form\Bootstrap3\Templates;

class BaseTemplatesTest extends AbstractTemplatesTest
{
    public function testButton()
    {
        $this->assertSame(
            '<button type="button" class="btn btn-default" >Click</button>',
            $this->renderTemplate('base', 'button')
        );
    }
    
    public function testButtonAttributes()
    {
        $this->assertSame(
            '<button type="submit" class="btn btn-danger&#x20;btn-lg" disabled>Submit me!</button>',
            $this->renderTemplate('base', 'button', [
                'type'     => 'submit',
                'class'    => 'btn-danger btn-lg',
                'label'    => 'Submit me!',
                'disabled' => true,
            ])
        );
    }
    
    public function testCheckbox()
    {
        $expected = <<<HTML
<div class="checkbox">
    <label >
        <input type="checkbox"  value="on" >
            </label>
</div>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'checkbox'));
    }
    
    public function testCheckboxAttributes()
    {
        $expected = <<<HTML
<div class="checkbox">
    <label for="my-id">
        <input type="checkbox" id="my-id" name="my-id" style="font-size&#x3A;&#x20;12px&#x3B;" value="1" checked>
        My Label    </label>
</div>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'checkbox', [
            'id'      => 'my-id',
            'name'    => 'my-id',
            'label'   => 'My Label',
            'style'   => 'font-size: 12px;',
            'class'   => 'ignore-me',
            'value'   => 1,
            'checked' => true,
        ]));
    }
    
    public function testCheckboxes()
    {
        $expected = <<<HTML
    <div class="checkbox">
        <label>
            <input type="checkbox" name="my_id[]" id="my_id_l1" value="l1" >
            Label 1        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="my_id[]" id="my_id_l2" value="l2" checked>
            Label 2        </label>
    </div>

HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'checkboxes', [
            'id'      => 'my_id',
            'name'    => 'my_id',
            'options' => [
                'l1' => 'Label 1',
                'l2' => 'Label 2',
            ],
            'value' => ['l2'],
        ]));
    }
    
    public function testCheckboxesWithJustLabels()
    {
        $expected = <<<HTML
    <div class="checkbox">
        <label>
            <input type="checkbox" name="[]" id="_0" value="0" >
            Label 1        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="[]" id="_1" value="1" >
            Label 2        </label>
    </div>

HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'checkboxes', [
            'options' => ['Label 1', 'Label 2'],
        ]));
    }
    
    public function testCheckboxesWithoutOptions()
    {
        $this->assertSame('', $this->renderTemplate('base', 'checkboxes'));
    }
    
    public function testErrors()
    {
        $expected = <<<HTML
    <div class="alert alert-danger my-class&#x20;my-other-class">
        <p>Please check the following fields:</p>
        <ul>
                            <li>Error 1</li>
                            <li>Error 2</li>
                    </ul>
    </div>

HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'errors', [
            'class' => 'my-class my-other-class',
            'errors' => [
                'Error 1',
                'Error 2',
            ]
        ]));
    }
    
    public function testInput()
    {
        $expected = <<<HTML
<input type="text" class="form-control "  >
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'input'));
    }
    
    public function testInputAttributes()
    {
        $expected = <<<HTML
<input type="password" class="form-control my-class&#x20;my-other-class" id="my_id" name="my_name" style="font-weight&#x3A;&#x20;bold&#x3B;" placeholder="Placeholder&#x20;..." value="Something" disabled>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'input', [
            'type'        => 'password',
            'id'          => 'my_id',
            'name'        => 'my_name',
            'class'       => 'my-class my-other-class',
            'style'       => 'font-weight: bold;',
            'placeholder' => 'Placeholder ...',
            'value'       => 'Something',
            'disabled'    => true,
        ]));
    }
    
    public function testHiddenInput()
    {
        $expected = <<<HTML
<input type="hidden" >
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'input_hidden'));
    }
    
    public function testHiddenInputAttributes()
    {
        $expected = <<<HTML
<input type="hidden" id="my_id" name="my_name" value="Something">
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'input_hidden', [
            'id'          => 'my_id',
            'name'        => 'my_name',
            'value'       => 'Something',
        ]));
    }
    
    public function testRadios()
    {
        $expected = <<<HTML
    <div class="radio">
        <label>
            <input type="radio" name="my_name" id="my_id_v1" value="v1" >
            Label 1        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="my_name" id="my_id_v2" value="v2" checked>
            Label 2        </label>
    </div>

HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'radios', [
            'id'      => 'my_id',
            'name'    => 'my_name',
            'options' => [
                'v1' => 'Label 1',
                'v2' => 'Label 2',
            ],
            'value' => 'v2',
        ]));
    }
    
    public function testRadiosWithJustLabels()
    {
        $expected = <<<HTML
    <div class="radio">
        <label>
            <input type="radio"  id="_0" value="0" >
            Label 1        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio"  id="_1" value="1" >
            Label 2        </label>
    </div>

HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'radios', [
            'options' => ['Label 1', 'Label 2'],
        ]));
    }
    
    public function testRadiosWithoutOptions()
    {
        $this->assertSame('', $this->renderTemplate('base', 'radios'));
    }
    
    public function testSelect()
    {
        $expected = <<<HTML
<select class="form-control "  >
    </select>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'select'));
    }
    
    public function testSelectAttributes()
    {
        $expected = <<<HTML
<select class="form-control my-class&#x20;my-other-class" id="my_id" name="my_name" style="font-weight&#x3A;&#x20;bold&#x3B;" disabled>
            <option value="one" >One</option>
            <option value="two" selected>Two</option>
            <option value="three" >Three</option>
    </select>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'select', [
            'id'      => 'my_id',
            'name'    => 'my_name',
            'class'   => 'my-class my-other-class',
            'style'   => 'font-weight: bold;',
            'value'   => 'two',
            'options' => [
                'one'   => 'One',
                'two'   => 'Two',
                'three' => 'Three',
            ],
            'disabled' => true,
        ]));
    }
    
    public function testSubmit()
    {
        $expected = <<<HTML
<button type="submit" class="btn btn-primary" name="submit" >Submit</button>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'submit'));
    }
    
    public function testSubmitAttributes()
    {
        $expected = <<<HTML
<button type="submit" class="btn btn-danger&#x20;btn-lg" name="my_submit" disabled>My label</button>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'submit', [
            'name'     => 'my_submit',
            'class'    => 'btn-danger btn-lg',
            'label'    => 'My label',
            'disabled' => true,
        ]));
    }
    
    public function testTextarea()
    {
        $expected = <<<HTML
<textarea class="form-control " rows="3"  ></textarea>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'textarea'));
    }
    
    public function testTeatareaAttributes()
    {
        $expected = <<<HTML
<textarea class="form-control my-class&#x20;my-other-class" rows="10" id="my_id" name="my_name" style="font-weight&#x3A;&#x20;bold&#x3B;" placeholder="Placeholder&#x20;..." disabled>Something
is going on.</textarea>
HTML;
        $this->assertSame($expected, $this->renderTemplate('base', 'textarea', [
            'rows'        => 10,
            'id'          => 'my_id',
            'name'        => 'my_name',
            'class'       => 'my-class my-other-class',
            'style'       => 'font-weight: bold;',
            'placeholder' => 'Placeholder ...',
            'value'       => "Something\r\nis going on.",
            'disabled'    => true,
        ]));
    }
}
