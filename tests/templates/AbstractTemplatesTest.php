<?php
namespace Tests\Formular\Form\Bootstrap3\Templates;
use bigwhoop\Formular\Template\FileTemplate;

abstract class AbstractTemplatesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $tplType
     * @param string $tplName
     * @param array $attributes
     * @return string
     */
    protected function renderTemplate($tplType, $tplName, array $attributes = [])
    {
        $tpl = new FileTemplate(__DIR__ . "/../../templates/$tplType/$tplName.phtml");
        return $tpl->render($attributes);
    }
}
