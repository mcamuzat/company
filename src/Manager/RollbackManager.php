<?php

namespace App\Manager;

use App\Entity\Company;
use App\Entity\History;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class RollbackManager
{
    private $em;

    private $serializer;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }
    
    public function save(Company $company) : void
    {
        // first restore the object
        $oldcompany = $this->em->getRepository(Company::class)->find($company->getid());
        // serialize it
        $jsonContent = $this->serializer->serialize($oldcompany, 'json');
        $history = (new History())
            ->setDate(new \DateTime())
            ->setDto($jsonContent)
            ->setIdObject($company->getId())
            ->setType(History::COMPANY_TYPE);

        // persist
        $this->em->persist($history);
        $this->em->flush();
    }

    public function restoreFrom(Company $company, DateTime $dateTime)
    {
        $result = $this->em->getRepository(History::class)->findByDate($company->getId(), $dateTime);
        if (count($result) === 0) {
            return null;
        }
        $company = $this->serializer->deserialize($result[0]->getDto(), Company::class, 'json');
        return $company; 
    }
}

