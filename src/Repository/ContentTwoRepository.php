<?php

namespace App\Repository;

use App\Entity\ContentTwo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method ContentTwo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContentTwo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContentTwo[]    findAll()
 * @method ContentTwo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentTwoRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(RegistryInterface $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, ContentTwo::class);
        $this->em = $em;
    }

    public function saveContent(string $data) : JsonResponse
    {
        $content = new ContentTwo();
        $content->setContent($data);
        $content->setContentPurified($data);
        $this->em->persist($content);
        $this->em->flush();

        return new JsonResponse([
            'html' => $content->getContent(),
            'htmlPurified' => $content->getContentPurified()
        ]);
    }
}
