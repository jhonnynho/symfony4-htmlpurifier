<?php

namespace App\Controller;

use App\Repository\ContentRepository;
use App\Repository\ContentTwoRepository;
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
    public function sent(Request $request, HtmlPurifierService $purifier, ContentRepository $contentRepository)
    {
        $html = json_decode($request->getContent());
        $data = $purifier->purifyHtml($html->html);
        $result = $contentRepository->saveContent($data);

        return $result;
    }

    /**
     * @Route("/sent/two", name="sent-two", methods={"POST"})
     */
    public function sentTwo(Request $request, ContentTwoRepository $contentTwoRepository)
    {
        $html = json_decode($request->getContent());
        $html = $html->html;
        $result = $contentTwoRepository->saveContent($html);

        return $result;
    }
}
