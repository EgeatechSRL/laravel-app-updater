<?php

namespace EgeaTech\AppUpdater\Contracts\Dto;

interface ApplicationsListRequestFilters extends ApplicationUpdaterRequestData
{
    public function getQueryWhereClauses(): array;
}
