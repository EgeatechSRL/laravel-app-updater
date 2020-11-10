<?php

namespace EgeaTech\AppUpdater\Dto;

use EgeaTech\AppUpdater\Constants\BuildChannel;
use EgeaTech\AppUpdater\Contracts\Dto\ApplicationsListRequestFilters;

class ApplicationsListFilters implements ApplicationsListRequestFilters
{
    private $_buildChannel;

    public function __construct(array $requestFilters)
    {
        $this->_buildChannel = BuildChannel::coerce($requestFilters['build_channel']);
    }

    public function getBuildChannel(): BuildChannel
    {
        return $this->_buildChannel;
    }

    public function getQueryWhereClauses(): array
    {
        return [
            ['build_channel', '=', $this->getBuildChannel()->value],
        ];
    }
}
