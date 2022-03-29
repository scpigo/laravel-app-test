<?php

namespace App\Modules\xml_1c_exchange\src\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use NeedleProject\LaravelRabbitMq\PublisherInterface;
use Scpigo\Core\Factory\DtoFactory;
use Scpigo\Laravel1cXml\Dto\XmlExchangeConfigDto;

class TestController extends Controller
{
    public function test() {
        $publisher = app()->makeWith(PublisherInterface::class, ['microservice-publisher']);
        $message = [
            'class' => 'TestLaravel',
            'title' => 'Hello world',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        ];
        $routingKey = '*';
        $publisher->publish(json_encode($message), /* optional */$routingKey);
    }
}