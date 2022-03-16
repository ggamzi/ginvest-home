<?php

namespace App\Mail;
use App\Models\Log;
use App\Models\AlertEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Alert extends Mailable
{
    use Queueable, SerializesModels;
    
    public $email_content;
    
    /**
     * Create a new message instance.
     * @param string $ip    : ip주소
     * @param string $category  : 이슈 종류
     * 
     * @return void
     */
    public function __construct($email_content)
    {
        $this->email_content = $email_content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 발송할 메일 주소
        $to_email = AlertEmail::where('is_use','Y')->pluck('email');
        // 입력받은 내용
        $input = $this->email_content;

        $ip = $input['ip'];
        
        $res = Log::where('ip',$ip)->orderby('created_at','desc')->first();
        $data['res'] = $res;

        return $this->from('webmaster@mail-invest.co.kr','ginvest_관리자')->to($to_email)->subject('[관리자 알림] '.$res->category)->view('mails.alert', $data);
    }
}