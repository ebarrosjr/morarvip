<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\EnderecoService;
use Cake\ORM\TableRegistry;

/**
 * Imoveis Controller
 *
 * @property \App\Model\Table\ImoveisTable $Imoveis
 */
class ImoveisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userId = $this->currentUserId();
        $query = $this->accessibleImoveisQuery($userId)
            ->contain(['Categorias', 'TipoImoveis']);
        $imoveis = $this->paginate($query);

        $this->set(compact('imoveis', 'userId'));
    }

    /**
     * View method
     *
     * @param string|null $id Imovei id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $imovei = $this->getAccessibleImovel($id, ['Categorias', 'TipoImoveis', 'Pessoas', 'FotoImoveis']);
        $userId = $this->currentUserId();
        $isOwner = (int)$imovei->user_id === $userId;

        $this->set(compact('imovei', 'userId', 'isOwner'));
    }

    public function add()
    {
        $imovei = $this->Imoveis->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data = $this->normalizeCheckboxData($data);
            $data['user_id'] = $this->Authentication->getIdentity()->id;
            $pessoa = $data['pessoa'];
            $tblPessoas = TableRegistry::getTableLocator()->get('Pessoas');
            $proprietario = $tblPessoas->find()->where(['email' => $pessoa['email']])->first();
            if(!$proprietario) {
                $newPessoa = $tblPessoas->newEmptyEntity();
                $pessoa['origem'] = 'C';
                $newPessoa = $tblPessoas->patchEntity($newPessoa, $pessoa);
                $tblPessoas->save($newPessoa);
                $data['proprietario'] = $newPessoa->id;
            } else {
                $data['proprietario'] = $proprietario->id;
            }

            $data = $this->fillAddressData($data);

            $imovei = $this->Imoveis->patchEntity($imovei, $data);

            if ($this->Imoveis->save($imovei)) {
                $this->Flash->success(__('The imovei has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The imovei could not be saved. Please, try again.'));
        }

        $categorias = $this->Imoveis->Categorias->find('list', limit: 200)->all();
        $tipos = $this->Imoveis->TipoImoveis->find('list', limit: 200)->all();
        $this->set(compact('imovei', 'categorias', 'tipos'));
    }

    public function edit($id = null)
    {
        $imovei = $this->getOwnedImovel($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data = $this->normalizeCheckboxData($data);

            $data = $this->fillAddressData($data);

            $imovei = $this->Imoveis->patchEntity($imovei, $data);

            if ($this->Imoveis->save($imovei)) {
                $this->Flash->success(__('The imovei has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The imovei could not be saved. Please, try again.'));
        }

        $categorias = $this->Imoveis->Categorias->find('list', limit: 200)->all();
        $tipos = $this->Imoveis->TipoImoveis->find('list', limit: 200)->all();
        $this->set(compact('imovei', 'categorias', 'tipos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Imovei id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $imovei = $this->getOwnedImovel($id);
        if ($this->Imoveis->delete($imovei)) {
            $this->Flash->success(__('The imovei has been deleted.'));
        } else {
            $this->Flash->error(__('The imovei could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Abre formulário para upload de fotos do imóvel e quando submetido, salva as fotos e associa ao imóvel na tabela fotos
     * @param string|null $id Imovei id.
     * @return \Cake\Http\Response|null Renders view
     */
    public function fotos($id)
    {
        $imovel = $this->getOwnedImovel($id, ['FotoImoveis']);
        if($this->request->is('post')) {
            $data = $this->request->getData();
            $files = $data['fotos'] ?? [];
            $principal = !empty($data['principal']);

            if (!is_array($files)) {
                $files = [$files];
            }

            $files = array_filter($files, function ($file) {
                return $file && $file->getError() !== UPLOAD_ERR_NO_FILE;
            });

            if (!empty($files)) {
                if ($principal) {
                    $this->Imoveis->FotoImoveis->updateAll(
                        ['principal' => false],
                        ['imovel_id' => $id]
                    );
                }

                $uploadPath = $this->getImageUploadPath();
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0775, true);
                }

                $salvas = 0;
                foreach ($files as $file) {
                    if ($file->getError() === UPLOAD_ERR_OK) {
                        $extension = $this->getImageExtension($file->getClientMediaType());
                        $filename = $id . '_' . uniqid() . $extension;
                        $file->moveTo($uploadPath . $filename);

                        $fotoEntity = $this->Imoveis->FotoImoveis->newEmptyEntity();
                        $fotoEntity->imovel_id = $id;
                        $fotoEntity->arquivo = $filename;
                        $fotoEntity->principal = $principal && $salvas === 0;

                        if ($this->Imoveis->FotoImoveis->save($fotoEntity)) {
                            $salvas++;
                        }
                    }
                }

                if ($salvas > 0) {
                    $this->Flash->success(__('Fotos salvas com sucesso!'));
                    return $this->redirect(['action' => 'view', $id]);
                }

                $this->Flash->error(__('Não foi possível salvar as fotos. Por favor, tente novamente.'));
            } else {
                $this->Flash->error(__('Nenhuma foto foi selecionada. Por favor, tente novamente.'));
            }
        }

        $this->set(compact('imovel'));
    }

    public function deleteFoto($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $foto = $this->getOwnedFoto($id);
        $imovelId = $foto->imovel_id;
        $filePath = $this->getImageUploadPath() . $foto->arquivo;

        if ($this->Imoveis->FotoImoveis->delete($foto)) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->Flash->success(__('Foto deletada com sucesso!'));
        } else {
            $this->Flash->error(__('Não foi possível deletar a foto. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'view', $imovelId]);
    }

    public function setPrincipal($id)
    {
        $this->request->allowMethod(['post']);

        $foto = $this->getOwnedFoto($id);
        $imovelId = $foto->imovel_id;

        $this->Imoveis->FotoImoveis->updateAll(
            ['principal' => false],
            ['imovel_id' => $imovelId]
        );

        $foto->principal = true;
        if ($this->Imoveis->FotoImoveis->save($foto)) {
            $this->Flash->success(__('Foto definida como principal!'));
        } else {
            $this->Flash->error(__('Não foi possível definir a foto como principal. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'view', $imovelId]);
    }

    private function getImageUploadPath(): string
    {
        return IMAGE_UPLOAD_PATH;
    }

    private function fillAddressData(array $data): array
    {
        if (!empty($data['cep'])) {
            $endereco = EnderecoService::getEnderecoByCep((string)$data['cep']);
            if ($endereco) {
                $data['cep'] = $endereco['cep'] ?? $data['cep'];
                $data['rua'] = $endereco['logradouro'] ?? ($data['rua'] ?? null);
                $data['bairro'] = $endereco['bairro'] ?? ($data['bairro'] ?? null);
                $data['cidade'] = $endereco['cidade'] ?? ($data['cidade'] ?? null);
                $data['uf'] = $endereco['estado'] ?? ($data['uf'] ?? null);
                $data['pais'] = $endereco['pais'] ?? ($data['pais'] ?? 'Brasil');
            }
        }

        $addressString = EnderecoService::buildAddressString($data);
        $coord = EnderecoService::getCoordenadas($addressString);
        $data['latitude'] = $coord['latitude'];
        $data['longitude'] = $coord['longitude'];

        return $data;
    }

    private function normalizeCheckboxData(array $data): array
    {
        foreach ([
            'financia',
            'comissao_permanente',
            'show_site',
            'show_preco_site',
            'corretor_opcionista',
            'exclusividade',
            'parceiria',
        ] as $field) {
            $data[$field] = !empty($data[$field]) ? 1 : 0;
        }

        return $data;
    }

    private function currentUserId(): int
    {
        return (int)$this->Authentication->getIdentity()->getIdentifier();
    }

    private function accessibleImoveisQuery(int $userId)
    {
        $imoveisEmParceria = $this->validPartnershipImoveisQuery($userId);

        return $this->Imoveis
            ->find()
            ->where([
                'OR' => [
                    'Imoveis.user_id' => $userId,
                    'Imoveis.id IN' => $imoveisEmParceria,
                ],
            ]);
    }

    private function validPartnershipImoveisQuery(int $userId)
    {
        $today = date('Y-m-d');

        return $this->fetchTable('ImovelParcerias')
            ->find()
            ->select(['ImovelParcerias.imovei_id'])
            ->where([
                'ImovelParcerias.parceiro_id' => $userId,
                'ImovelParcerias.situacao' => 'A',
                'ImovelParcerias.deleted IS' => null,
                [
                    'OR' => [
                        'ImovelParcerias.inicio_parceria IS' => null,
                        'ImovelParcerias.inicio_parceria <=' => $today,
                    ],
                ],
                [
                    'OR' => [
                        'ImovelParcerias.fim_parceria IS' => null,
                        'ImovelParcerias.fim_parceria >=' => $today,
                    ],
                ],
            ]);
    }

    private function getAccessibleImovel($id, array $contain = [])
    {
        return $this->accessibleImoveisQuery($this->currentUserId())
            ->where(['Imoveis.id' => $id])
            ->contain($contain)
            ->firstOrFail();
    }

    private function getOwnedImovel($id, array $contain = [])
    {
        return $this->Imoveis
            ->find()
            ->where([
                'Imoveis.id' => $id,
                'Imoveis.user_id' => $this->currentUserId(),
            ])
            ->contain($contain)
            ->firstOrFail();
    }

    private function getOwnedFoto($id)
    {
        return $this->Imoveis->FotoImoveis
            ->find()
            ->contain(['Imoveis'])
            ->where([
                'FotoImoveis.id' => $id,
                'Imoveis.user_id' => $this->currentUserId(),
            ])
            ->firstOrFail();
    }

    private function getImageExtension(?string $mediaType): string
    {
        return match ($mediaType) {
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'image/gif' => '.gif',
            'image/webp' => '.webp',
            default => '',
        };
    }
}
