<?php

class MyXmlConvert extends CApplicationComponent
{
    public static function array2xml($data, $rootNodeName = 'data', $xml = null)
    {
        if ($xml == null) {
            $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
        }

        foreach ($data as $key => $value) {
            $key = preg_replace('/[^a-z\_]/i', '', $key);

            if (empty($key)) {
                $key = 'item';
            }

            if (is_array($value) && $key != 'attributes') {
                $node = $xml->addChild($key);
                self::array2xml($value, $rootNodeName, $node);
            } else if (is_array($value)) {
                foreach ($value as $attribute_key => $attribute_value) {
                    $xml->addAttribute($attribute_key, $attribute_value);
                }
            } else {
                $xml->addChild($key, $value);
            }
        }

        $doc = new DOMDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->loadXML($xml->asXML());
        $doc->formatOutput = true;

        return $doc->saveXML();
    }

    public static function xml2array($xml)
    {
        return simplexml_load_string($xml);
    }
}
