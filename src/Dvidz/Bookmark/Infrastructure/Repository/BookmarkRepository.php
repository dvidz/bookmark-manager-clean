<?php

namespace Dvidz\Bookmark\Infrastructure\Repository;


use Doctrine\Common\Annotations\AnnotationReader;
use Dvidz\Bookmark\Domain\Aggregate\Bookmark;
use Dvidz\Bookmark\Domain\Repository\BookmarkRepository as DomainBookmarkRepository;
use Dvidz\Bookmark\Infrastructure\Entity\Bookmark as BookmarkEntity;
use Dvidz\Shared\Infrastructure\Symfony\Repository\BaseRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class BookmarkRepository.
 */
class BookmarkRepository extends BaseRepository implements DomainBookmarkRepository
{
    /**
     * @param Bookmark $bookmark
     *
     * @return BookmarkEntity
     */
    public function bookmark(Bookmark $bookmark)
    {
        $jsonContent = json_encode($bookmark->toArray());

        $bookmarkEntity = BookmarkEntity::fromArray($bookmark->toArray());
        $em = $this->getEntityManager();
        $em->persist($bookmarkEntity);
        $em->flush();

        return $bookmarkEntity;
    }

    /**
     * @return string
     */
    protected function className(): string
    {
        return BookmarkEntity::class;
    }
}
