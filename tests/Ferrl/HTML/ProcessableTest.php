<?php

namespace tests\Ferrl\HTML;

use Ferrl\Html\Processable;
use tests\TestCase;

class ProcessableTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = Processable::class;

    /**
     * Template HTML string.
     *
     * @var string
     */
    protected $template;

    /**
     * Setup tag template.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->template = ':has-label-begin::label::has-label-end: - :text: - :has-help-begin::help::has-help-end:';
        $this->invokeInaccessibleMethod('setTemplate', [$this->template]);
    }

    /**
     * getTemplate return defined template.
     */
    public function testHasTemplateSet()
    {
        $this->assertEquals($this->template, $this->invokeInaccessibleMethod('getTemplate'));
    }

    /**
     * getConditionalFields returns the list of conditional fields.
     */
    public function testHasListOfConditionalFields()
    {
        $conditional = $this->invokeInaccessibleMethod('getConditionalFields', [$this->template]);

        $this->assertEquals(['label', 'text', 'help'], $conditional);
    }

    /**
     * removeUnusedConditionalBlocks remove conditions that were not matched.
     */
    public function testRemovesUnusedConditionalBlocks()
    {
        $template = $this->invokeInaccessibleMethod('removeUnusedConditionalBlocks', [$this->template, ['label' => 'Name']]);

        $this->assertContains('has-label-begin', $template);
        $this->assertContains('has-label-end', $template);
        $this->assertNotContains('has-help-begin', $template);
        $this->assertNotContains('has-help-end', $template);
    }

    /**
     * removeUnusedConditionalFields remove conditions that were not matched.
     */
    public function testRemovesUnusedConditionalFields()
    {
        $template = $this->invokeInaccessibleMethod('removeUnusedConditionalFields', [$this->template, []]);

        $this->assertNotContains(':text:', $template);
    }

    /**
     * process render an bootstrap form field.
     */
    public function testProcessAllFields()
    {
        $rendered = $this->invokeInaccessibleMethod('process', [['label' => 'Name', 'text' => 'Text', 'help' => 'No abbreviations']]);
        $expected = 'Name - Text - No abbreviations';

        $this->assertEquals($expected, $rendered);
    }
}
