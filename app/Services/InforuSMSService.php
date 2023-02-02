<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InforuSMSService
{
    protected string $senderName;
    protected string $login;
    protected string $apiToken;
    protected string $xmlEndpoint;
    protected bool $serviceEnabled;

    public function __construct(array $config)
    {
        $this->senderName = $config['sender_name'];
        $this->login = $config['login'];
        $this->apiToken = $config['api_token'];
        $this->xmlEndpoint = $config['xml_endpoint'];
        $this->serviceEnabled = $config['service_enabled'];
    }

    protected function generateXMLMessage($phoneNumber, $message): string
    {
        $xml = '<Inforu>'.PHP_EOL;
        $xml .= '  <User>'.PHP_EOL;
        $xml .= '    <Username>'.$this->login.'</Username>'.PHP_EOL;
        $xml .= '    <ApiToken>'.$this->apiToken.'</ApiToken>'.PHP_EOL;
        $xml .= '  </User>'.PHP_EOL;
        $xml .= '  <Content Type="sms">'.PHP_EOL;
        $xml .= '    <Message>'.htmlspecialchars($message).'</Message>'.PHP_EOL;
        $xml .= '  </Content>'.PHP_EOL;
        $xml .= '  <Recipients>'.PHP_EOL;
        $xml .= '    <PhoneNumber>'.$phoneNumber.'</PhoneNumber>'.PHP_EOL;
        $xml .= '  </Recipients>'.PHP_EOL;
        $xml .= '  <Settings>'.PHP_EOL;
        $xml .= '    <Sender>'.$this->senderName.'</Sender>'.PHP_EOL;
        $xml .= '  </Settings>'.PHP_EOL;
        $xml .= '</Inforu>';

        return $xml;
    }

    public function sendMessage($phoneNumber, $message): void
    {
        $request = Http::get($this->xmlEndpoint, [
            'InforuXML' => $this->generateXMLMessage($phoneNumber, $message)
        ]);

        if ($request->failed()) {
            Log::error($request->body());
        }
    }

    public function isServiceEnabled(): bool
    {
        return $this->serviceEnabled;
    }
}
