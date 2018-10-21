<?php

namespace App\Repository;

use App\Entity\Locale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


final class LocaleRepository extends ServiceEntityRepository
{
    /**
     * @var Repository
     */
    private $repository;
    /**
     * @var string
     */
    private $parametersDefaultLocale;
    /**
     * @var array
     */
    private $parametersAvailableLocales;


    public function __construct(string $parametersDefaultLocale, array $parametersAvailableLocales, RegistryInterface $registry)
    {
        
        $this->parametersDefaultLocale = $parametersDefaultLocale;
        $this->parametersAvailableLocales = $parametersAvailableLocales;

        parent::__construct($registry, Locale::class);
    }

    /**
     * Return defaultLocale code
     * @return string
     */
    public function getDefaultLocale()
    {
        $defaultLocale = $this->parametersDefaultLocale;
        $dbDefaultLocale = $this->findOneBy(array('isDefault'=>true));
        if($dbDefaultLocale){
            $defaultLocale = $dbDefaultLocale->getCode();
        }
        return $defaultLocale;
    }

    /**
     * Return array of availableLocale code
     * @return array
     */
    public function getAvailableLocales()
    {
        $qb = $this->createQueryBuilder('l');
        $qb->select('l.code AS locales');
        $result = $qb->getQuery()->getResult();
        $availableLocales = array_map(function($el){ return $el['locales']; }, $result);
        if(empty($availableLocales)){
            $availableLocales = $this->parametersAvailableLocales;
        }
        return $availableLocales;
    }
}