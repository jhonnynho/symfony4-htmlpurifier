<?php

namespace App\Controller;

use App\Service\HtmlPurifierService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SampleController extends Controller
{
    /**
     * @Route("/sent", name="sent", methods={"POST"})
     */
    public function sent(Request $request, HtmlPurifierService $purifier)
    {
        $html = json_decode($request->getContent());

        $purify = $purifier->purifyHtml($html->html);

        return new JsonResponse(
            [
                'html' => $purify
            ]
        );
    }
}
