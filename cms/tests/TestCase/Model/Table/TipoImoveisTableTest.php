<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoImoveisTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoImoveisTable Test Case
 */
class TipoImoveisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoImoveisTable
     */
    protected $TipoImoveis;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TipoImoveis',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TipoImoveis') ? [] : ['className' => TipoImoveisTable::class];
        $this->TipoImoveis = $this->getTableLocator()->get('TipoImoveis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TipoImoveis);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\TipoImoveisTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
