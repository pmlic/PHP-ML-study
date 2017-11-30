<?php
namespace pf\arr\build;

trait PFArrFormat {
    public $rootNodeName='root';
    public $type_func=array(
        'json'=>'format_json',
        'xml'=>'format_xml',
        'serialize'=>'format_serialize',
        'obj'      =>'format_obj',
        'csv'      =>'format_csv'
    );

    public function pf_encode($array,$type='json') {
        if(method_exists($this, $this->type_func[$type])) {
            return call_user_func(array($this,$this->type_func[$type]), $array);
        }
        else{
            throw new Exception(sprintf('The required method "'.$this->type_func[$type].'" does not exist for!', $this->type_func[$type], get_class($this)));
        }
    }

    private function format_json($array) {
        return json_encode($array);
    }

    private function format_xml($array) {
        if (ini_get('zend.ze1_compatibility_mode') == 1)
        {
            ini_set ('zend.ze1_compatibility_mode', 0);
        }
        return $this->toXml($array,$this->rootNodeName);
    }

    private function format_serialize($array) {
        $array = serialize($array);
        return $array;
    }

    private function toXml($data, $rootNodeName = 'root', $xml=null) {
        if ($xml == null)
        {
            $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
        }
        foreach($data as $key => $value)
        {
            if (is_numeric($key))
            {
                $key = "unknownNode_". (string) $key;
            }

            if (is_array($value))
            {
                $node = $xml->addChild($key);
                $this->toXml($value, $rootNodeName, $node);
            }
            else
            {
                $value =htmlentities($value,ENT_QUOTES,'UTF-8');
                $xml->addChild($key,$value);
            }

        }
        return $xml->asXML();
    }

    public function format_csv($data)
    {
        if (is_array($data) and isset($data[0]))
        {
            $headings = array_keys($data[0]);
        }
        else
        {
            $headings = array_keys((array) $data);
            $data = array($data);
        }
        $output = implode(',', $headings) . "\r\n";
        foreach ($data as &$row)
        {
            $output .= '"' . implode('","', (array) $row) . "\"\r\n";
        }
        return $output;
    }


    private function format_obj($array) {
        $array = json_encode($array);
        $arr = json_decode($array,false);
        return $arr;
    }
}