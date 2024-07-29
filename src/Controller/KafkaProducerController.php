<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Rdkafka\Conf;

class KafkaProducerController extends AbstractController
{
    #[Route('kafka/test', name: 'kafka_test')]
    public function send(): void
    {
        $conf = new Rdkafka\Conf();
    }
}