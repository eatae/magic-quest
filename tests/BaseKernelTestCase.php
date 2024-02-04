<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseKernelTestCase extends KernelTestCase
{
    protected EntityManagerInterface $em;
    protected ValidatorInterface $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->em = self::getContainer()->get(EntityManagerInterface::class);
        $this->validator = self::getContainer()->get(ValidatorInterface::class);
    }
}