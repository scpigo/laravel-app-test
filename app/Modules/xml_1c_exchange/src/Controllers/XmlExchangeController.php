<?php

namespace App\Modules\xml_1c_exchange\src\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\xml_1c_exchange\src\Helpers\XmlExchangeFields;
use App\Modules\xml_1c_exchange\src\Models\Order;
use App\Modules\xml_1c_exchange\src\Models\OrdersProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Mtownsend\XmlToArray\XmlToArray;
use Spatie\ArrayToXml\ArrayToXml;
use Spatie\Fractal\Facades\Fractal;
use Spatie\Fractalistic\ArraySerializer;

class XmlExchangeController extends Controller
{
    public function upload(Request $request) {
        $xml = Storage::disk('sftp')->get('1c/order.xml');

        var_dump($xml);
    }

    public function read(Request $request) {
        $data = $this->getArray();

        $array = Fractal::create()
            ->item($data, new \Scpigo\Laravel1cXml\Drivers\Mongo\Transformers\OrderXmlTransformer())
            ->serializeWith(new ArraySerializer())
            ->toArray();

        $xml = ArrayToXml::convert($array, 'Документ', false, 'UTF-8');
        
        print_r($xml);
    }

    private function getArray() {
        return [
            'uid' => '25b54e86-e909-11e3-b256-00248cae1f0f',
            'number' => '09.04.2014 0:46:38',
            'date' => '09.04.2014 0:46:38',
            'operation' => 'Заказ товара',
            'role' => 'Продавец',
            'currency' => 'RUB',
            'rate' => 1.0000,
            'sum' => 7503.00,
            'time' => '09.04.2014 0:46:38',
            'comment' => '№ 102 localhost',
            'counterparty' => [
                'uid' => '4659b786-be79-11e3-826d-00248cae1f0f',
                'name' => 'Test Test',
                'role' => 'Покупатель',
                'full_name' => 'Test Test',
            ],
            'products' => [
                'product' => [
                    [
                        'uid' => '22a6b2be-aae3-11e3-93cd-00248cae1f0f#b02e283e-720f-11df-b436-0015e92f2802',
                        'vendor_code' => '849943893',
                        'name' => 'Ботинки',
                        'base_unit' => [
                            '_attributes' => [
                                'Код' => '715',
                                'НаименованиеПолное' => 'Пара (2 шт.)',
                                'МеждународноеСокращение' => 'NPR'
                            ],
                            '_value' => 'пар'
                        ],
                        'unit_price' => 1200.00,
                        'quantity' => 2,
                        'cost' => 2400.00,
                        'attributes_values' => [
                            'attribute_value' => [
                                [
                                    'name' => 'ВидНоменклатуры',
                                    'value' => 'Обувь'
                                ],
                                [
                                    'name' => 'ТипНоменклатуры',
                                    'value' => 'Товар'
                                ]
                            ]
                        ]
                    ],
                    [
                        'uid' => '22a6b2be-aae3-11e3-93cd-00248cae1f0f#b02e283e-720f-11df-b436-0015e92f2802',
                        'vendor_code' => '849943893',
                        'name' => 'Сапоги',
                        'base_unit' => [
                            '_attributes' => [
                                'Код' => '715',
                                'НаименованиеПолное' => 'Пара (2 шт.)',
                                'МеждународноеСокращение' => 'NPR'
                            ],
                            '_value' => 'пар'
                        ],
                        'unit_price' => 1200.00,
                        'quantity' => 2,
                        'cost' => 2400.00,
                        'attributes_values' => [
                            'attribute_value' => [
                                [
                                    'name' => 'ВидНоменклатуры',
                                    'value' => 'Обувь'
                                ],
                                [
                                    'name' => 'ТипНоменклатуры',
                                    'value' => 'Товар'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'attributes_values' => [
                'attribute_value' => [
                    [
                        'name' => 'Номер по 1С',
                        'value' => 'ТДЦБ-000015'
                    ],
                    [
                        'name' => 'Дата по 1С',
                        'value' => '2014-06-01T0:20:10'
                    ],
                    [
                        'name' => 'ПометкаУдаления',
                        'value' => 'false'
                    ],
                    [
                        'name' => 'Проведен',
                        'value' => 'true'
                    ]
                ]
            ]
        ];
    }
}
