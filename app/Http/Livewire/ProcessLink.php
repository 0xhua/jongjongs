<?php

namespace App\Http\Livewire;

use DOMDocument;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class ProcessLink extends Component
{
    public $payment_link = '';

    public function render()
    {
        return view('livewire.process-link', [
            'bypass' => $this->generateLink()
        ]);
    }

    private function generateLink(){
        if ($this->payment_link){
            $vpc = [];
            $contents = Http::get($this->payment_link);
            $dom = new DOMDocument();
            @$dom->loadHTML($contents->body());
            foreach ($dom->getElementsByTagName('input') as $node) {
                $vpc[$node->getAttribute('name')] = $node->getAttribute('value');
            }
            $vpc['vpc_ReturnURL'] = str_replace('https://nodecde1.paynamics.net/possible/transaction/wf/cc/validate/transact/token/', '', $vpc['vpc_ReturnURL']);
            switch (strtolower($vpc['vpc_card'])) {
                case 'mastercard':
                    $vpc['card_type'] = 'MC';
                    break;
                case 'visa':
                    $vpc['card_type'] = 'VC';
                    break;
            }
            $dsTransactionId =Str::uuid();
            $vertoken = urlencode($this->hashrand(25));
            $authid = $this->intrand(6);
            $transactionno = "51000141" . $this->intrand(3);
            $ReceiptNo = "23081870" . $this->intrand(4);
            $link = 'https://nodecde1.paynamics.net/possible/transaction/wf/cc/validate/transact/token/' . $vpc['vpc_ReturnURL'] . '?vpc_3DS2dsTransactionId=' . $dsTransactionId . '&vpc_3DSECI=05&vpc_3DSenrolled=Y&vpc_3DSstatus=Y&vpc_AVSRequestCode=Z&vpc_AVSResultCode=Unsupported&vpc_AcqAVSRespCode=Unsupported&vpc_AcqCSCRespCode=M&vpc_AcqResponseCode=00&vpc_Amount=' . $vpc['vpc_Amount'] . '&vpc_AuthenticationVersion=2&vpc_AuthorizeId=' . $authid . '&vpc_BatchNo=20221016&vpc_CSCResultCode=M&vpc_Card=' . $vpc['card_type'] . '&vpc_Command=pay&vpc_Currency=PHP&vpc_Locale=en_US&vpc_MerchTxnRef=' . $vpc['vpc_MerchTxnRef'] . '&vpc_Merchant=' . $vpc['vpc_Merchant'] . '&vpc_Message=Approved&vpc_OrderInfo=' . $vpc['vpc_OrderInfo'] . '&vpc_ReceiptNo=' . $ReceiptNo . '&vpc_SecureHash=' . $vpc['vpc_SecureHash'] . '&vpc_SecureHashType=SHA256&vpc_TransactionNo=' . $transactionno . '&vpc_TxnResponseCode=0&vpc_VerSecurityLevel=05&vpc_VerStatus=Y&vpc_VerToken=' . $vertoken . '%3D&vpc_VerType=3DS&vpc_Version=1';
            return $link;

        }
        return null;
//        $this->info('PAYMENT BYPASS SUCCESS FULLY CREATED');
//        $this->comment('LINK: ' . $link);
//        $this->newLine();
//        $this->comment('Transaction Info');
//        $this->info('Return URL: ' . $vpc['vpc_ReturnURL']);
//        $this->info('Amount: ' . $vpc['vpc_Amount']);
//        $this->info('Card Type: ' . $vpc['card_type']);
//        $this->info('Merch Txn Ref: ' . $vpc['vpc_MerchTxnRef']);
//        $this->info('Merch: ' . $vpc['vpc_Merchant']);
//        $this->info('OrderInfo: ' . $vpc['vpc_OrderInfo']);
//        $this->info('Secure Hash: ' . $vpc['vpc_SecureHash']);
//        $this->newLine();
//        $this->comment('Generated Info');
//        $this->info('3DS2dsTransactionId: ' . $dsTransactionId);
//        $this->info('Ver Token: ' . $vertoken);
//        $this->info('Auth Id: ' . $authid);
//        $this->info('Transaction No: ' . $transactionno);
//        $this->info('Receipt No: ' . $ReceiptNo);
    }

    private function strrand($l)
    {
        return substr(str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789'), 0, $l);
    }

    private function hashrand($l)
    {
        return substr(str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789=+'), 0, $l);
    }

    private function intrand($l)
    {
        return substr(str_shuffle('01223456789'), 0, $l);
    }

    private function hexrand($l)
    {
        return substr(str_shuffle('0123456789abcdef'), 0, $l);
    }
}
