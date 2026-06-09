<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImovelParceriasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImovelParceriasTable Test Case
 */
class ImovelParceriasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ImovelParceriasTable
     */
    protected $ImovelParcerias;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.ImovelParcerias',
        'app.Imoveis',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ImovelParcerias') ? [] : ['className' => ImovelParceriasTable::class];
        $this->ImovelParcerias = $this->getTableLocator()->get('ImovelParcerias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ImovelParcerias);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ImovelParceriasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ImovelParceriasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
