<?php

namespace App\Services;

use App\Models\SettingModel;
use App\Models\InstitutionModel;
use App\Models\NotificationTemplateModel;

class WakitaService
{
    protected const REQUEST_TIMEOUT = 15;

    protected SettingModel $settingModel;

    protected InstitutionModel $institutionModel;

    protected NotificationTemplateModel $templateModel;

    protected ?array $config = null;

    public function __construct()
    {
        $this->settingModel     = new SettingModel();
        $this->institutionModel = new InstitutionModel();
        $this->templateModel    = new NotificationTemplateModel();
    }

    public function isEnabled(): bool
    {
        $config = $this->getConfig();

        if (! $config) {
            return false;
        }

        return (int) ($config['wakita_enabled'] ?? 0) === 1
            && ! empty($config['wakita_api_url'])
            && ! empty($config['wakita_api_key']);
    }

    public function getConfig(): ?array
    {
        if ($this->config !== null) {
            return $this->config;
        }

        $institution = $this->institutionModel
            ->where('active', true)
            ->first();

        if (! $institution) {
            $this->config = null;
            return null;
        }

        $setting = $this->settingModel
            ->where('institution_id', $institution['id'])
            ->first();

        $this->config = $setting ?: null;

        return $this->config;
    }

    public function sendMessage(
        string $phone,
        string $message,
        string $context = ''
    ): bool {

        if (! $this->isEnabled()) {
            log_message(
                'info',
                '[WAKITA] Nonaktif atau config belum lengkap. Skip kirim ke '
                    . $this->maskPhone($phone)
                    . ($context ? ' (' . $context . ')' : '')
            );

            return true;
        }

        $phone = $this->normalizePhone($phone);

        if ($phone === '') {
            log_message(
                'warning',
                '[WAKITA] Nomor HP tidak valid. Skip kirim.'
            );

            return false;
        }

        $config = $this->getConfig();

        try {
            $response = $this->doRequest(
                $config['wakita_api_url'],
                $config['wakita_api_key'],
                $config['wakita_sender'] ?? '',
                $phone,
                $message
            );

            if ($response['success']) {
                log_message(
                    'info',
                    '[WAKITA] Pesan terkirim ke '
                        . $this->maskPhone($phone)
                        . ($context ? ' (' . $context . ')' : '')
                );

                return true;
            }

            log_message(
                'warning',
                '[WAKITA] Gagal kirim ke '
                    . $this->maskPhone($phone)
                    . '. Response: ' . $response['body']
                    . ($context ? ' (' . $context . ')' : '')
            );

            return false;
        } catch (\Throwable $e) {

            log_message(
                'error',
                '[WAKITA] Exception saat kirim: ' . $e->getMessage()
            );

            return false;
        }
    }

    public function sendToGuest(array $visit, string $type): bool
    {
        $phone = trim((string) ($visit['phone'] ?? ''));

        if ($phone === '') {
            log_message(
                'info',
                '[WAKITA] Nomor HP tamu kosong. Skip notif ke tamu.'
            );

            return false;
        }

        $template = $this->getTemplate('guest', $type);

        if (! $template) {
            log_message(
                'info',
                '[WAKITA] Template tidak ditemukan untuk guest/' . $type
            );

            return false;
        }

        $message = $this->buildMessage(
            $template['template_message'],
            $visit
        );

        return $this->sendMessage(
            $phone,
            $message,
            'guest/' . $type . ' - ' . ($visit['visit_code'] ?? '')
        );
    }

    public function sendToEmployee(array $visit, string $type): bool
    {
        $phone = trim((string) ($visit['employee_phone'] ?? ''));

        if ($phone === '') {
            log_message(
                'info',
                '[WAKITA] Nomor HP pegawai kosong. Skip notif ke pegawai.'
            );

            return false;
        }

        $template = $this->getTemplate('employee', $type);

        if (! $template) {
            log_message(
                'info',
                '[WAKITA] Template tidak ditemukan untuk employee/' . $type
            );

            return false;
        }

        $message = $this->buildMessage(
            $template['template_message'],
            $visit
        );

        return $this->sendMessage(
            $phone,
            $message,
            'employee/' . $type . ' - ' . ($visit['visit_code'] ?? '')
        );
    }

    protected function getTemplate(
        string $recipientType,
        string $notificationType
    ): ?array {
        return $this->templateModel
            ->where('recipient_type', $recipientType)
            ->where('notification_type', $notificationType)
            ->where('active', 1)
            ->first();
    }

    protected function buildMessage(string $template, array $visit): string
    {
        $replacements = [
            '{guest_name}'        => $visit['guest_name'] ?? '-',
            '{guest_phone}'       => $visit['phone'] ?? '-',
            '{institution}'       => $visit['institution'] ?? '-',
            '{visit_code}'        => $visit['visit_code'] ?? '-',
            '{employee_name}'     => $visit['employee_name'] ?? '-',
            '{employee_phone}'    => $visit['employee_phone'] ?? '-',
            '{department_name}'   => $visit['department_name'] ?? '-',
            '{purpose_name}'      => $visit['purpose_name'] ?? '-',
            '{group_size}'        => $visit['group_size'] ?? '-',
            '{arrival_time}'      => $visit['arrival_time'] ?? '-',
            '{check_in}'          => $visit['check_in'] ?? '-',
            '{check_out}'         => $visit['check_out'] ?? '-',
        ];

        return strtr($template, $replacements);
    }

    protected function doRequest(
        string $url,
        string $apiKey,
        string $sender,
        string $phone,
        string $message
    ): array {

        $endpoint = rtrim($url, '/');

        if (! str_ends_with($endpoint, '/send')) {
            $endpoint .= '/send';
        }

        $payload = [
            'number'  => $phone,
            'message' => $message,
        ];

        $headers = [
            'X-API-Key: ' . $apiKey,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_TIMEOUT        => self::REQUEST_TIMEOUT,
            CURLOPT_CONNECTTIMEOUT => self::REQUEST_TIMEOUT,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $body = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        if ($error) {
            return [
                'success' => false,
                'body'    => 'cURL error: ' . $error,
                'code'    => 0,
            ];
        }

        $response = json_decode($body ?: '{}', true);

        $isSuccess = $httpCode >= 200
            && $httpCode < 300
            && isset($response['success'])
            && $response['success'] === true;

        return [
            'success' => $isSuccess,
            'body'    => $body ?: '',
            'code'    => $httpCode,
        ];
    }

    protected function normalizePhone(string $phone): string
    {

        $phone = preg_replace('/[^0-9]/', '', $phone);

        if ($phone === '') {
            return '';
        }

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        if (substr($phone, 0, 1) === '8') {
            $phone = '62' . $phone;
        }

        if (strlen($phone) < 10) {
            return '';
        }

        return $phone;
    }

    protected function maskPhone(string $phone): string
    {
        if (strlen($phone) < 8) {
            return $phone;
        }

        return substr($phone, 0, 4)
            . '****'
            . substr($phone, -4);
    }
}
