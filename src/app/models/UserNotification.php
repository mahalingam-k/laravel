

<?php
/**
 * Created by PhpStorm.
 * User: Tine
 * Date: 27/06/14
 * Time: 23:50
 */


class UserNotification extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_notification';
	
	public function user() {

        return $this->belongsTo('User', 'created_by');
    }
	
	public function prepareMailContent($message, $valuesArray)
	{
		log::info($message);
		preg_match_all("/{{(.*?)}}/", $message, $results);
	//	log::info($results);
		foreach($results[1] as $res)
		{
			if($res=='email')
			{
				$message =  str_replace('{{email}}',$valuesArray['email'],$message);
			}
		}
		//log::info($message);
		$valuesArray['template'] = $message;
		
		Mail::send($valuesArray['viewpage'], $valuesArray, function($message) use($valuesArray) 
		{
			$message->to($valuesArray['to1'], $valuesArray['to2']);
			$message->subject($valuesArray['subject']);
			if(array_key_exists("path",$valuesArray))
			{
				$message->attach($valuesArray['path']);
			}
		});
		
		
	/*	if (array_key_exists("confirmation_code",$valuesArray))
		{
			Mail::send($valuesArray['viewpage'], array('template'=>$message,'confirmation_code' => $valuesArray['confirmation_code']), function($message) use($valuesArray) 
			{
				$message->to($valuesArray['to1'], $valuesArray['to2']);
				$message->subject($valuesArray['subject']);
			}); 
		}
		else if(array_key_exists("token",$valuesArray))
		{
			Mail::send($valuesArray['viewpage'], array('template'=>$message,'token' => $valuesArray['token']), function($message) use($valuesArray) 
			{
				$message->to($valuesArray['to1'], $valuesArray['to2']);
				$message->subject($valuesArray['subject']);
			}); 
		}
		else
		{
			Mail::send($valuesArray['viewpage'], array('template'=>$message), function($message) use($valuesArray) 
			{
				$message->to($valuesArray['to1'], $valuesArray['to2']);
				$message->subject($valuesArray['subject']);
				if(array_key_exists("path",$valuesArray))
				{
					$message->attach($valuesArray['path']);
				}
			}); 
		} */
		//return $message;
	}
}