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
        $query = $this->Imoveis->find()
            ->contain(['Categorias', 'TipoImoveis']);
        $imoveis = $this->paginate($query);

        $this->set(compact('imoveis'));
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
        $imovei = $this->Imoveis->get($id, contain: ['Categorias', 'TipoImoveis', 'Pessoas', 'FotoImoveis']);
        $this->set(compact('imovei'));
    }

    public function add()
    {
        $imovei = $this->Imoveis->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
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

            // 1) ViaCEP (preenche campos se vierem vazios ou se você quiser sempre sobrescrever)
            if (!empty($data['cep'])) {
                $end = EnderecoService::getEnderecoByCep((string)$data['cep']);
                if ($end) {
                    // escolha: sobrescrever sempre, ou só se estiver vazio
                    foreach (['cep','logradouro','bairro','cidade','estado','pais'] as $k) {
                        if (empty($data[$k]) && isset($end[$k])) {
                            $data[$k] = $end[$k];
                        }
                    }
                }
            }

            // 2) Geocode (usa os dados já “completos”)
            $addressString = EnderecoService::buildAddressString($data);
            $coord = EnderecoService::getCoordenadas($addressString);

            $data['latitude'] = $coord['latitude'];
            $data['longitude'] = $coord['longitude'];

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
        $imovei = $this->Imoveis->get($id, contain: []);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (!empty($data['cep'])) {
                $end = EnderecoService::getEnderecoByCep((string)$data['cep']);
                if ($end) {
                    foreach (['cep','logradouro','bairro','cidade','estado','pais'] as $k) {
                        if (empty($data[$k]) && isset($end[$k])) {
                            $data[$k] = $end[$k];
                        }
                    }
                }
            }

            $addressString = EnderecoService::buildAddressString($data);
            $coord = EnderecoService::getCoordenadas($addressString);
            $data['latitude'] = $coord['latitude'];
            $data['longitude'] = $coord['longitude'];

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
        $imovei = $this->Imoveis->get($id);
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
        $imovel = $this->Imoveis->get($id, contain: ['FotoImoveis']);
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

        $foto = $this->Imoveis->FotoImoveis->get($id);
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

        $foto = $this->Imoveis->FotoImoveis->get($id);
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
