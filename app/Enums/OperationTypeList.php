<?php

namespace App\Enums;

enum LanguageList: int
{
    case EN = 1;
    case ES = 2;
    case DE = 3;
    case FR = 4;
    case RO = 5;
    case IT = 6;
    case PT = 7;

    public function alias() :string
    {
        return match($this) 
        {
            LanguageList::EN => 'En',
            LanguageList::ES => 'Es',
            LanguageList::DE => 'De',
            LanguageList::FR => 'Fr',
            LanguageList::RO => 'Ro',
            LanguageList::IT => 'It',
            LanguageList::PT => 'Pt',
        };
    }
    

    public static function getAllValues() :array
    {
        $array = [];
        $cases = LanguageList::cases();
        for ($i = 0; $i < sizeof($cases); $i++) {
            $array[$i] = Self::getValues($cases[$i]);
        }
        
        return $array;
    }

    public static function getValues($enum) :array
    {
        return [
            'id' => $enum->value,
            'name' => $enum->alias(),
        ];
    }

    public static function getAllValuesById() :array
    {
        return array_column(LanguageList::cases(), 'value');
    }

}