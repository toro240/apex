<?php

namespace App\Services\Tasks;

class TaskSearchCriteria
{
    private int $groupId;
    private ?string $subject = null;
    private array $maps = [];
    private array $legends = [];
    private ?string $contents = null;
    private ?string $limitedAtFrom = null;
    private ?string $limitedAtTo = null;
    private array $targetUsers = [];
    private int $sort;

    public function __construct($groupId, $sort)
    {
        $this->groupId = $groupId;
        $this->sort = $sort;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @return string|null
     */
    public function getSubject(): string|null
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return array
     */
    public function getMaps(): array
    {
        return $this->maps;
    }

    /**
     * @param array $maps
     */
    public function setMaps(array $maps): void
    {
        $this->maps = $maps;
    }

    /**
     * @return array
     */
    public function getLegends(): array
    {
        return $this->legends;
    }

    /**
     * @param array $legends
     */
    public function setLegends(array $legends): void
    {
        $this->legends = $legends;
    }

    /**
     * @return string|null
     */
    public function getContents(): ?string
    {
        return $this->contents;
    }

    /**
     * @param string $contents
     */
    public function setContents(string $contents): void
    {
        $this->contents = $contents;
    }

    /**
     * @return string|null
     */
    public function getLimitedAtFrom(): ?string
    {
        return $this->limitedAtFrom;
    }

    /**
     * @param string $limitedAtFrom
     */
    public function setLimitedAtFrom(string $limitedAtFrom): void
    {
        $this->limitedAtFrom = $limitedAtFrom;
    }

    /**
     * @return string|null
     */
    public function getLimitedAtTo(): ?string
    {
        return $this->limitedAtTo;
    }

    /**
     * @param string $limitedAtTo
     */
    public function setLimitedAtTo(string $limitedAtTo): void
    {
        $this->limitedAtTo = $limitedAtTo;
    }

    /**
     * @return array
     */
    public function getTargetUsers(): array
    {
        return $this->targetUsers;
    }

    /**
     * @param array $targetUsers
     */
    public function setTargetUsers(array $targetUsers): void
    {
        $this->targetUsers = $targetUsers;
    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return $this->sort;
    }
}
