<?php

namespace App\Modules\xml_1c_exchange\src\Controllers;

use App\Http\Controllers\Controller;
use Scpigo\Core\Factory\DtoFactory;
use Scpigo\Laravel1cXml\Dto\XmlExchangeConfigDto;

class TestController extends Controller
{
    public function test() {
        $array = DtoFactory::createArray(config('1c.exchangers'), XmlExchangeConfigDto::class);

        print_r($array);
    }
}