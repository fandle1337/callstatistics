<?php

namespace App\Console\Commands;

use App\Dto\DtoPortal;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Service\ServiceCallUpload;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UploadCalls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload-calls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Загрузить статистику звонков';

    /**
     * Execute the console command.
     */
    public function handle(
        InterfaceRepositoryPortal $repositoryPortal,
        ServiceCallUpload         $serviceCallUpload
    ): void
    {
        $activeClients = $repositoryPortal->getActiveClients();
        /** @var DtoPortal $client */
        foreach ($activeClients as $client) {
            $serviceCallUpload->upload($client);
        }
    }

}
