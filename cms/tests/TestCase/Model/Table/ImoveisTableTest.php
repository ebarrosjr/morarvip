<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImoveisTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImoveisTable Test Case
 */
class ImoveisTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ImoveisTable
     */
    protected $Imoveis;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Imoveis',
        'app.Users',
        'app.Categorias',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Imoveis') ? [] : ['className' => ImoveisTable::class];
        $this->Imoveis = $this->getTableLocator()->get('Imoveis', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Imoveis);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ImoveisTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ImoveisTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
