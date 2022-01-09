<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

interface SitemapInterface
{
    /**
     * @return SitemapUrlInterface[]
     */
    public function getUrls(): iterable;

    /**
     * @param SitemapUrlInterface[] $urlSet
     */
    public function setUrls(array $urlSet): void;

    public function addUrl(SitemapUrlInterface $url): void;

    public function removeUrl(SitemapUrlInterface $url): void;

    /**
     * @return string
     */
    public function getLocalization(): ?string;

    public function setLocalization(string $localization): void;

    /**
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    public function setLastModification(DateTimeInterface $lastModification): void;
}
