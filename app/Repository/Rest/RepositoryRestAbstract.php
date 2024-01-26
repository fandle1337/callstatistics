<?php

namespace App\Repository\Rest;

use Bitrix24\SDK\Core\Batch;
use Bitrix24\SDK\Core\Core;

class RepositoryRestAbstract
{
    protected ?Core $core = null;
    protected ?Batch $batch = null;

    public function getCore(): ?Core
    {
        return $this->core;
    }

    public function setCore(?Core $core): self
    {
        $this->core = $core;
        return $this;
    }

    public function getBatch(): ?Batch
    {
        return $this->batch;
    }

    public function setBatch(?Batch $batch): self
    {
        $this->batch = $batch;
        return $this;
    }
}
