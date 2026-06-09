<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FotoImoveisTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FotoImoveisTable Test Case
 */
class FotoImoveisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FotoImoveisTable
     */
    protected $FotoImoveis;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.FotoImoveis',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FotoImoveis') ? [] : ['className' => FotoImoveisTable::class];
        $this->FotoImoveis = $this->getTableLocator()->get('FotoImoveis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FotoImoveis);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\FotoImoveisTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
