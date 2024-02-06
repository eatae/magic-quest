<?php

declare(strict_types=1);

namespace App\Tests;

use App\DataFixtures\AppFixtures;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class DebugFixturesTest extends KernelTestCase
{
    protected static Container $container;

    public function testAppFixture()
    {
        $fixture = self::getContainer()->get(AppFixtures::class);
        $fixture->load(self::getContainer()->get(EntityManagerInterface::class));

        $this->assertTrue(true);
    }
}
