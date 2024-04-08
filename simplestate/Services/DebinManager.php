<?php

namespace SimpleState\Services;

use Illuminate\Support\Facades\Http;
use SimpleState\Models\AccountBank;
use SimpleState\Models\Transaction;

class DebinManager{

    private $debinUrl = "https://sandbox.bind.com.ar/v1";

    private $debinTokenUrl = "https://api.simplestate.co/api/test/bind";

    private $debinToken = null;

    protected function getDebinToken(){
        if($this->debinToken){
            return $this->debinToken;
        }

        $this->debinToken = Http::get($this->debinTokenUrl)->throw()->json("token");

        return $this->debinToken;
    }

    /**
     * Make Body for Debin
     *
     * @param string $cbu
     * @param integer $amount
     * @param integer $transaction_id
     *
     * @return Object
     */
    protected function makeBodyDebin(string $cbu, int $amount, int $transaction_id){
        return $transaction = [
                        'origin_id' => $transaction_id,
                        'to' => ['cbu' => $cbu],
                        'value' => ['currency' => "ARS", "amount" => $amount],
                        'concept' => 'EXP',
                        'expiration' => 36
                       ];

    }

    /**
     * Create de Debing
     *
     * @param integer $bank_id
     * @param string $account_id
     * @param string $cbu
     * @param integer $amount
     * @param integer $transaction_id
     *
     * @return String
     */
    public function createDebin(int $bank_id,string $account_id,string $cbu, int $amount, int $transaction_id){
        $token = $this->getDebinToken();
        $data  = $this->makeBodyDebin($cbu,$amount,$transaction_id);
        $response = Http::withToken($token)
                         ->post("{$this->debinUrl}/banks/{$bank_id}/accounts/{$account_id}/owner/transaction-request-types/DEBIN/transaction-requests", $data)
                         ->throw()
                         ->json('id');
        return $response;
    }

    /**
     * Take Debin Status
     *
     * @param integer $bank_id
     * @param string $account_id
     * @param integer $debin_id
     *
     * @return String
     */
    public function takeDebinStatus(int $bank_id,string $account_id,int $debin_id){
        $token = $this->getDebinToken();
        $response = Http::withToken($token)
            ->get("{$this->debinUrl}/banks/{$bank_id}/accounts/{$account_id}/owner/transaction-request-types/DEBIN/{$debin_id}")
            ->throw()
            ->json('status');

        return $response;

    }
}