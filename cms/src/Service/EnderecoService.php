<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Cache\Cache;
use Cake\Http\Client;
use Cake\I18n\DateTime;

class EnderecoService
{
    /**
     * Normaliza CEP: mantém só dígitos.
     */
    public static function normalizeCep(?string $cep): string
    {
        return preg_replace('/\D+/', '', (string)$cep);
    }

    /**
     * ViaCEP -> retorna array com campos ou null.
     */
    public static function getEnderecoByCep(string $cep): ?array
    {
        $cep = self::normalizeCep($cep);

        if ($cep === '' || strlen($cep) !== 8) {
            return null;
        }

        $cacheKey = 'viacep_' . $cep;

        /** @var array|null $endereco */
        $endereco = Cache::read($cacheKey, 'default');
        if ($endereco !== null) {
            return $endereco;
        }

        $http = new Client([
            'headers' => [
                'Accept' => 'application/json',
            ],
            'timeout' => 10,
        ]);

        $response = $http->get("https://viacep.com.br/ws/{$cep}/json/");

        if (!$response->isOk()) {
            return null;
        }

        $dados = $response->getJson();
        if (!is_array($dados) || empty($dados) || !empty($dados['erro'])) {
            return null;
        }

        $endereco = [
            'cep'        => $cep,
            'logradouro' => $dados['logradouro'] ?? null,
            'bairro'     => $dados['bairro'] ?? null,
            'cidade'     => $dados['localidade'] ?? null,
            'estado'     => $dados['uf'] ?? null,
            'pais'       => 'Brasil',
        ];

        Cache::write($cacheKey, $endereco, 'default');
        return $endereco;
    }

    /**
     * Nominatim -> retorna ['latitude' => '...', 'longitude' => '...'] ou nulls
     */
    public static function getCoordenadas(string $addressString): array
    {
        $addressString = trim($addressString);
        $cacheKey = 'geocode_' . md5($addressString);

        /** @var array|null $coord */
        $coord = Cache::read($cacheKey, 'default');
        if ($coord !== null) {
            return $coord;
        }

        $coord = ['latitude' => null, 'longitude' => null];

        if ($addressString === '') {
            Cache::write($cacheKey, $coord, 'default');
            return $coord;
        }

        $http = new Client([
            'headers' => [
                // importante no Nominatim
                'User-Agent' => 'MolezaApp/1.0 (tecnologia@moleza.app)',
                'Accept' => 'application/json',
            ],
            'timeout' => 15,
        ]);

        $response = $http->get('https://nominatim.openstreetmap.org/search', [
            'q' => $addressString,
            'format' => 'json',
            'limit' => 1,
        ]);

        if ($response->isOk()) {
            $json = $response->getJson();
            if (is_array($json) && !empty($json[0]['lat']) && !empty($json[0]['lon'])) {
                $coord['latitude'] = (string)$json[0]['lat'];
                $coord['longitude'] = (string)$json[0]['lon'];
            }
        }

        // TTL 6h (no Cache config, ou você pode usar pool específico)
        Cache::write($cacheKey, $coord, 'default');

        return $coord;
    }

    /**
     * Monta uma string “boa” pra geocode.
     * Você pode ajustar a ordem/itens conforme seu schema.
     */
    public static function buildAddressString(array $data): string
    {
        $parts = array_filter([
            $data['logradouro'] ?? null,
            $data['numero'] ?? null,
            $data['bairro'] ?? null,
            $data['cidade'] ?? null,
            $data['estado'] ?? null,
            $data['cep'] ?? null,
            $data['pais'] ?? 'Brasil',
        ], fn($v) => $v !== null && trim((string)$v) !== '');

        return implode(', ', array_map('trim', $parts));
    }
}
