<?php 

class crud
{
	private $login;
    private $password;
    private $mail;
    private $name;
    private $hesh;
    private $file;

public function __construct($login, $password, $mail, $name, $hesh, $file)
    {
        $this->login = $login;
         $this->password = $password;
          $this->mail = $mail;
           $this->name = $name;
            $this->hesh = $hesh;
            $this->file = $file;
       
    }

    public function inputData()
    {
        $array = array(
	'login' => $this->login, 
	'password' => md5($this->password . $this->hesh), 
	'mail' => $this->mail, 
	'name' => $this->name,
	'hesh' => $this->hesh,
					);
        $taskList = json_decode($this->file, true);
	$taskList[] = $array;
	file_put_contents('data.json', json_encode($taskList));
    }

    public function readData()
    {
        return json_decode($this->file, true);
    }

    public function deleteData()
    {
        
        $json_arr = json_decode($this->file, true);
        $arr_index = array();
        foreach ($json_arr as $key => $value)
        {
            if ($value['login'] == $this->login &&  $value['password'] == md5($this->password . $value['hesh']) && $value['mail'] == $this->mail)
            {
                $arr_index[] = $key;
            }
        }
        foreach ($arr_index as $i)
        {
            unset($json_arr[$i]);
        }
        $json_arr = array_values($json_arr);
        file_put_contents('data.json', json_encode($json_arr));
            
    }

    public function UpdateData($loginТNEW, $passwordNEW, $mailNEW, $nameNEW)
    {
        
        $json_arr = json_decode($this->file, true);
        foreach ($json_arr as $key => $value) {
        if ($value['login'] == $this->login &&  $value['password'] == md5($this->password . $value['hesh']) && $value['mail'] == $this->mail) {
            $json_arr[$key]['login'] = $loginТNEW;
            $json_arr[$key]['password'] = $passwordNEW;
            $json_arr[$key]['mail'] = $mailNEW;
            $json_arr[$key]['name'] = $nameNEW;
            }
        }
        file_put_contents('data.json', json_encode($json_arr));        
    }
}
?>