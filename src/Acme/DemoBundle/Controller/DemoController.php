<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acme\DemoBundle\Entity\Attributes;

class DemoController extends Controller
{
    /**
     * @Route("/list", name="_demo_list")
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request)
    {
        $attributes = $this->setAttributes(new Attributes(), $request);

        $validator = $this->get('validator');
        $errors = $validator->validate($attributes);

        if (count($errors) > 0) {
            $errorsString = (string)$errors;
            var_dump($errorsString);

            $response = new Response();

            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->headers->set('Content-Type', 'text/html');

            $response->send();
            return $response;
        }

        $repo = $this->getDoctrine()->getManager()->getRepository('Acme\DemoBundle\Entity\User');
        $list = $repo->findActiveUsers();

        foreach ($list as $item) {
            $this->printImage(
                $attributes->getWidth(),
                $attributes->getHeight(),
                $attributes->getBgColor(),
                $attributes->getTextColor()
            );
            echo "\r\n";
        }
        $response = new Response();

        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        $response->send();
        return $response;
    }

    private function setAttributes($attributes, $request)
    {
        $attributes->setWidth($request->get('width'));
        $attributes->setHeight($request->get('height'));
        $attributes->setBgColor($request->get('bgColor'));
        $attributes->setTextColor($request->get('textColor'));

        return $attributes;
    }

    private function printImage($width, $height, $bgColorHex, $textColorHex)
    {
        $tmpPng = 'tmp.png';
        $text = rand(0, 100) . '%';
        $im = @imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
        $bgColorRGB = $this->hex2rgb($bgColorHex);
        $textColor = $this->hex2rgb($textColorHex);

        $centerx = ((imagesx($im) / 2) - (strlen($text) / 2));
        $centery = ((imagesy($im) / 2) - (strlen($text) / 2));

        imagecolorallocate($im, $bgColorRGB[0], $bgColorRGB[1], $bgColorRGB[2]);
        $text_color = imagecolorallocate($im, $textColor[0], $textColor[1], $textColor[2]);
        imagestring($im, 11, $centerx, $centery, $text, $text_color);

        imagepng($im, $tmpPng);
        imagedestroy($im);

        $type = pathinfo($tmpPng, PATHINFO_EXTENSION);
        $data = file_get_contents($tmpPng);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        echo '<img src="' . $base64 . '" />';

        unlink($tmpPng);
    }

    private function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);

        return $rgb;
    }
}
