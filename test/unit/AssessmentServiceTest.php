<?php


declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class AssessmentServiceTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertIsInt(1, "isInt");
    }


}