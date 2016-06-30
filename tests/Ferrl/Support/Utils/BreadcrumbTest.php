<?php

namespace tests\Ferrl\Support\Utils;

use Ferrl\Support\Utils\Breadcrumb;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Illuminate\View\Factory as View;
use tests\TestCase;

class BreadcrumbTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected $underTest = Breadcrumb::class;

    /**
     * Example of ferrl configuration.
     *
     * @var array|null
     */
    protected $ferrl = null;

    /**
     * Setup module configuration file.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        /* @noinspection PhpIncludeInspection */
        $this->ferrl = require realpath(__DIR__.'/../../../../stub/tests/ferrl.php');

        /** @var View $factory */
        $factory = app(View::class);
        $factory->addNamespace('layouts', realpath(__DIR__.'/../../../../stub/application/resources/layouts'));

        config(['ferrl' => $this->ferrl]);
    }

    /**
     * Class under test must be instantiable.
     */
    public function testIsInstantiable()
    {
        $this->assertInstanceOf(Breadcrumb::class, $this->getReflection()->newInstance());
    }

    /**
     * getPath must return an collection.
     */
    public function testPathIsAnCollection()
    {
        $this->assertInstanceOf(Collection::class, $this->invokeInaccessibleMethod('getPath'));
    }

    /**
     * addCrumb must add a single item to the path.
     */
    public function testAddCrumbAddsItemToCollection()
    {
        /** @var Breadcrumb $breadcrumb */
        $breadcrumb = $this->invokeInaccessibleMethod('addCrumb', ['Title', 'Url']);
        $path = $breadcrumb->getPath();

        $this->assertEquals(1, $path->count());
    }

    /**
     * renderCrumbs create an HTML list.
     */
    public function testRenderCrumbsCreatesHtmlList()
    {
        /** @var Breadcrumb $breadcrumb */
        $breadcrumb = $this->getReflection()->newInstance();
        $breadcrumb->addCrumb('First', 'first.html');
        $breadcrumb->addCrumb('Second', 'second.html');

        $crawler = new \DOMDocument;
        $crawler->loadHTML($breadcrumb->renderCrumbs());

        $this->assertEquals(1, $crawler->getElementsByTagName('ul')->length);
        $this->assertEquals(2, $crawler->getElementsByTagName('li')->length);
    }

    /**
     * createCrumb must create an fluent crumb.
     */
    public function testCreateCrumbCreatesFluentObject()
    {
        /* @var Breadcrumb $breadcrumb */
        $crumb = $this->invokeInaccessibleMethod('createCrumb', ['Title', 'item.html']);

        $this->assertInstanceOf(Fluent::class, $crumb);
        $this->assertEquals('Title', $crumb->title);
        $this->assertEquals('item.html', $crumb->url);
    }
}
