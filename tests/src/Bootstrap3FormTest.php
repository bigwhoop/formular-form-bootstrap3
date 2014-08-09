<?php
namespace Tests\Formular\Form\Bootstrap3;
use bigwhoop\Formular\Form\Bootstrap3\Bootstrap3Form;
use bigwhoop\Formular\TemplateFactory\FileBasedFactory;

class Bootstrap3FormTest extends \PHPUnit_Framework_TestCase
{
    private $defaultOptions = [
        'orientation'        => 'horizontal',
        'default_ns'         => 'bs3',
        'form_element'       => [],
        'errors_element'     => [],
        'csrf_element_name'  => '',
        'csrf_element_value' => '',
        'template_paths'     => [],
    ];
    
    
    public function testDefaultOptions()
    {
        $form = new Bootstrap3Form();
        $this->assertSame($this->defaultOptions, $this->readAttribute($form, 'options'));
    }
    
    
    public function testAllUserOptions()
    {
        $options = [
            'orientation'        => 'basic',
            'default_ns'         => 'my-ns',
            'form_element'       => [
                'id,name' => 'my-form',
                'class' => 'my-form',
            ],
            'errors_element'     => [
                'style' => 'font-weight: bold;'
            ],
            'csrf_element_name'  => 'csrf_token',
            'csrf_element_value' => 'asdasdasd',
            'template_paths'     => [
                __DIR__,
            ],
        ];
        
        $form = new Bootstrap3Form($options);
        $this->assertSame($options, $this->readAttribute($form, 'options'));
    }
    
    
    public function testUserOption()
    {
        $options = [
            'csrf_element_name'  => 'csrf_token',
            'csrf_element_value' => 'asdasdasd',
            'template_paths'     => [
                'ns' => __DIR__,
            ],  
        ];
        
        $form = new Bootstrap3Form($options);
        $this->assertSame($options + $this->defaultOptions, $this->readAttribute($form, 'options'));
    }
    
    
    public function testCustomUserOptions()
    {
        $options = [
            'foo' => 'bar',
        ];
        
        $form = new Bootstrap3Form($options);
        $this->assertSame($options + $this->defaultOptions, $this->readAttribute($form, 'options'));
    }
    
    
    public function testHorizontalTemplatePaths()
    {
        $form = new Bootstrap3Form([
            'template_paths' => [
                'ns1' => __DIR__,
                'ns2' => dirname(__DIR__),
            ],
        ]);
        
        /** @var FileBasedFactory $templates */
        $templates = $form->getTemplateFactory();
        
        $this->assertInstanceOf('bigwhoop\Formular\TemplateFactory\FileBasedFactory', $templates);
        $this->assertSame([
            realpath(__DIR__ . '/../../templates/horizontal') => Bootstrap3Form::NS,
            realpath(__DIR__ . '/../../templates/base') => Bootstrap3Form::NS_BASE,
            __DIR__ => 'ns1',
            dirname(__DIR__) => 'ns2',
        ], $this->readAttribute($templates, 'templatesPaths'));
    }
    
    
    public function testBasicTemplatePaths()
    {
        $form = new Bootstrap3Form([
            'orientation' => Bootstrap3Form::ORIENTATION_BASIC,
            'template_paths' => [
                'ns1' => __DIR__,
                'ns2' => dirname(__DIR__),
            ],
        ]);
        
        /** @var FileBasedFactory $templates */
        $templates = $form->getTemplateFactory();
        
        $this->assertInstanceOf('bigwhoop\Formular\TemplateFactory\FileBasedFactory', $templates);
        $this->assertSame([
            realpath(__DIR__ . '/../../templates/basic') => Bootstrap3Form::NS,
            realpath(__DIR__ . '/../../templates/base') => Bootstrap3Form::NS_BASE,
            __DIR__ => 'ns1',
            dirname(__DIR__) => 'ns2',
        ], $this->readAttribute($templates, 'templatesPaths'));
    }
}
