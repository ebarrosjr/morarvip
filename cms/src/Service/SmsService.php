<?php
declare(strict_types=1);

namespace App\Service;

use Cake\Core\Configure;
use Cake\Log\Log;
use Twilio\Rest\Client as TwilioClient;

class SmsService
{
    protected TwilioClient $client;

    protected string $fromNumber;
    protected string $messagingServiceSid;

    public function __construct(?TwilioClient $client = null)
    {
        $config = (array)Configure::read('Twilio');

        $accountSid = (string)($config['accountSid'] ?? env('TWILIO_ACCOUNT_SID', ''));
        $authToken = (string)($config['authToken'] ?? env('TWILIO_AUTH_TOKEN', ''));

        $this->fromNumber = (string)(
            $config['fromNumber']
            ?? $config['from']
            ?? env('TWILIO_FROM_NUMBER', '')
        );
        $this->messagingServiceSid = (string)(
            $config['messagingServiceSid']
            ?? env('TWILIO_MESSAGING_SERVICE_SID', '')
        );

        $this->client = $client ?? new TwilioClient($accountSid, $authToken);
    }

    public function sendText(string $phone, string $message): bool
    {
        $phone = $this->normalizePhoneToE164($phone);
        $message = trim($message);

        if ($phone === '' || $message === '') {
            return false;
        }

        $payload = ['body' => $message];
        if ($this->messagingServiceSid !== '') {
            $payload['messagingServiceSid'] = $this->messagingServiceSid;
        } elseif ($this->fromNumber !== '') {
            $payload['from'] = $this->fromNumber;
        } else {
            Log::error('Twilio SMS config missing fromNumber or messagingServiceSid.');
            return false;
        }

        try {
            $response = $this->client->messages->create($phone, $payload);
            Log::info(sprintf('Twilio SMS sent to %s. SID: %s Status: %s', $phone, $response->sid, $response->status));

            return true;
        } catch (\Throwable $e) {
            Log::error(sprintf('Twilio SMS exception to %s: %s', $phone, $e->getMessage()));
            return false;
        }
    }

    public function sendLink(
        string $phone,
        string $message,
        string $linkUrl,
        array $options = []
    ): bool {
        $title = trim((string)($options['title'] ?? ''));
        $description = trim((string)($options['linkDescription'] ?? ''));

        $parts = [trim($message)];
        if ($title !== '') {
            $parts[] = $title;
        }
        if ($description !== '') {
            $parts[] = $description;
        }
        $parts[] = trim($linkUrl);

        return $this->sendText($phone, implode("\n", array_filter($parts)));
    }

    public function normalizePhoneToE164(string $raw): string
    {
        $phone = preg_replace('/\D+/', '', $raw);
        if ($phone === '') {
            return '';
        }

        if (strpos($phone, '55') === 0 && strlen($phone) >= 12) {
            return '+' . $phone;
        }

        $phone = preg_replace(
            '/^(\d{8})$/',
            '219$1',
            preg_replace(
                '/^(\d{9})$/',
                '21$1',
                preg_replace('/^(\d{11})$/', '$1', $phone)
            )
        );

        return $phone ? '+55' . $phone : '';
    }
}
