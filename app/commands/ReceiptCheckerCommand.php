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
                $message = imap_fetchbody($inbox,$email_number,3);
                if(preg_match("/MSG-REF: (.*)/", $message, $matches)){
                    $message_id = intval($matches[1]);

                    $this->line('MSG-ID: '.$message_id.' Updated');

                    // Update message's tracker
                    if($message_id > 0){
                        $message = \Message\Message::find($message_id);
                        $message->receipt  = 1;
                        $message->save();
                    }
                }
            }
        }
	}
}
