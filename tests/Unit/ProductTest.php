<?php

namespace App\Tests\Unit;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel
        ->getContainer()
        ->get('doctrine')
        ->getManager();
    }

    public function testSetTitle()
    {
        $product = new Product();
        $product->setTitle('Test Product');

        $this->assertEquals('Test Product', $product->getTitle());
    }

    public function testSetContent()
    {
        $product = new Product();
        $product->setContent('Lorem ipsum dolor sit amet.');

        $this->assertEquals('Lorem ipsum dolor sit amet.',
        $product->getContent());
    }

    public function testSetPrice()
    {
        $product = new Product();
        $product->setPrice(19.99);

        $this->assertEquals(19.99, $product->getPrice());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
