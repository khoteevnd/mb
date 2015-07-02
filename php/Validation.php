<?php
class Validation
{
    private $errors;
    private $data;
    private $result;
    private $nocharaters;
    private $minlen;
    private $field_name;

    function __construct(&$data)
    {
        $this->data = $data;
        $this->errors = [];
        $this->minlen = MIN_LEN;
        $this->nocharaters = NO_CHAR;
        $this->result = true;
        $this->errors = [];
    }

//    public function validate($required = null, $minlen = null, $no_characters = null)
//    {
//
//        if($required == true)
//        {
//            $this->required();
//        }
//        if(is_array($minlen) and count($minlen) == 2)
//        {
//            $this->minlen($minlen[0], $minlen[1]);
//        }
//        if(is_array($no_characters) and count($no_characters) == 2)
//        {
//            $this->no_characters($no_characters[0], $no_characters[1]);
//        }
//
//    }
    public function required()
    {
        if(empty($this->data))
        {
            $this->result = false;
	        $this->errors[] = 'ErrorCode0';
        }
        return true;
    }

    public function minlen($minlen, $field_name)
    {
        $this->minlen = $minlen;
        $this->field_name = $field_name;
        if(strlen($this->data[$this->field_name])< $this->minlen)
        {
            $this->result = false;
            $this->errors[] = 'ErrorCode1';
        }
        return true;
    }

    public function no_characters($no_chars, $field_name)
    {
        $spec_char = $no_chars;
        $arr_spec_char = str_split($spec_char);
        $arr_str = str_split($this->data[$field_name]);
        $arr_return = [];

        foreach($arr_str as $str_char)
        {
            foreach($arr_spec_char as $spec)
            {
                if($str_char == $spec)
                {
                    $arr_return[]= $str_char;
                }
            }
        }
        if(($str=implode('',$arr_return)) != "")
        {
            $this->result = false;
            $this->errors[] = 'ErrorCode2';
        }
        else
        {
            return 0;
        }

    }
    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }
    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}

//$rules = [‘required’, ‘minlen:name:4’];
//
//function validator($data, $rules)
//{
//    $result = [‘status’=>true, ‘errors’=>[]];
//    foreach($rules as $rule)
//    {
//        $params = explode(‘:’, $rule);
//		$func = array_shift($params);
//		$func($result, $data, $params);
//    }
//}
//
//function required(&$result, $data, $params)
//{
//    if(empty($data))
//    {
//        $result[‘status’] = false;
//	    $result[‘errors’][] = ‘ErrorCode0’;
//    }
//}
//
//function minlen(&$result, $data, $params) {
//    list($name, $val) = $params;
//	if(strlen($data[$name])<$val)
//    {
//        $result[‘status’] = false;
//	    $result[‘errors’][] = ‘ErrorCode1’;
//    }
//}