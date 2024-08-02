<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Icewind\SMB\ServerFactory;
use Icewind\SMB\BasicAuth;


class smbTest extends AbstractController
{
    #[Route('smb/test', name: 'smb_test')]
    public function test(): Response {

        $path = "//AAGAPOV/share/YUNG/ЮЮ123123.jpg";

        $serverFactory = new ServerFactory();

        $auth = new BasicAuth('shareOverlord', null, '1');

        $resource = static::getArrResource($path);

        try {
            $server = $serverFactory->createServer($resource['host'], $auth);
            $share = $server->getShare($resource['dir']);
            $fileHandle = $share->read($resource['file']);
            $buf = stream_get_contents($fileHandle);
            fclose($fileHandle);
            dd(file_put_contents('test.jpg', $buf));
        } catch (\Exception $e) {
            dd( $e->getMessage());
            return false;
        }

        return $this->render('smb.html.twig', [
            'number' => $buf,
        ]);
    }

    public static function getArrResource(string $path): array
    {
        $matches = [];
        $path = self::getCorrectSMBPath($path);
        if (preg_match("/\/*([\w\S]+)\/(.*)\/([\w\S]+)/", $path, $matches)) {
            return [
                'host' => $matches[1],
                'dir' => $matches[2],
                'file' => $matches[3],
            ];
        }
        return [];
    }

    public static function getCorrectSMBPath(string $path): string
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }
}