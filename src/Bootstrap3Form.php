<?php
/**
 * This file is part of Formular.
 *
 * (c) Philippe Gerber
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace bigwhoop\Formular\Form\Bootstrap3;
use bigwhoop\Formular\Form;
use bigwhoop\Formular\TemplateFactory\FileBasedFactory;

/**
 * @author Philippe Gerber <philippe@bigwhoop.ch>
 */
class Bootstrap3Form extends Form
{
    const ORIENTATION_BASIC      = 'basic';
    const ORIENTATION_HORIZONTAL = 'horizontal';
    const ORIENTATION_INLINE     = 'inline';
    
    const NS = 'bs3';
    const NS_BASE = 'bs3_base';
    
    /** @var array */
    static protected $defaultOptions = [
        'orientation'        => self::ORIENTATION_HORIZONTAL,  // string. See self::ORIENTATION_*
        'default_ns'         => self::NS,                      // string|null. The default namespace for the form elements.
        'form_element'       => [],                            // array. Passed on to the form element.
        'errors_element'     => [],                            // array. Passed on to the errors element.
        'csrf_element_name'  => '',                            // string. If non-empty then a hidden element is automatically added ...
        'csrf_element_value' => '',                            // string. ... using this value.
        'template_paths'     => [],                            // array. Values are paths, keys can optionally be namespaces (if strings).
    ];
    
    
    public function init()
    {
        $this->setTemplateFactory($this->createDefaultFactory());
        
        $this->addElement('form@' . self::NS, $this->options['form_element'] + [
            'elements' => $this->bindContinue(),
        ]);
        
        $this->addElement('errors@' . self::NS, $this->options['errors_element'] + [
            'errors' => $this->bindErrorMessages(),
        ]);
        
        if (!empty($this->options['csrf_element_name'])) {
            $this->addElement('input@' . self::NS, [
                'type'    => 'hidden',
                'id,name' => $this->options['csrf_element_name'],
                'value'   => $this->options['csrf_element_value'],
            ]);
        }
    }


    /**
     * @return FileBasedFactory
     */
    protected function createDefaultFactory()
    {
        $templateFactory = new FileBasedFactory();
        $templateFactory->addTemplatesPath(__DIR__ . '/../templates/' . $this->options['orientation'], self::NS);
        $templateFactory->addTemplatesPath(__DIR__ . '/../templates/base', self::NS_BASE);
        $templateFactory->setDefaultNamespace($this->options['default_ns']);
        
        foreach ($this->options['template_paths'] as $ns => $path) {
            $templateFactory->addTemplatesPath($path, is_string($ns) ? $ns : null);
        }
        
        return $templateFactory;
    }
}
