<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ReceiptCheckerCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'receipt:check';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check inbox for read receipts.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $username = 'laravelcrm@one23.co.uk';
        $password = 'l4r4v3lcrm';
        $server = '{baracus.hyliahub.com:993/imap/ssl}INBOX';

        $inbox = imap_open($server, $username, $password);
        $emails = imap_search($inbox, 'UNSEEN');

        if(!empty($emails)){
            foreach($emails as $email_number){
                $message = imap_fetch_overview($inbox,$email_number,0);
                $subject = $message[0]->subject;
                $receipt_status = 0;

                if(preg_match("/MSG-REF: (.*)/", $subject, $matches)){ // Email is read
                    $message_id = intval(rtrim($matches[1],"]"));
                    $receipt_status = 1;
                    $this->line($message_id." : Read");
                } else { // Bounced email
                    $body = imap_fetchbody($inbox,$email_number,1);
                    if(preg_match("/MSG-REF: (.*)/", $body, $matches)){
                        $message_id = intval($matches[1]);
                        $receipt_status = -1;
                        $this->line($message_id." : Bounced");
                    }
                }

                if($message_id > 0){
                    $message = \Message\Message::find($message_id);
                    $message->receipt  = $receipt_status;
                    $message->save();
                }
            }
        }
	}
}
