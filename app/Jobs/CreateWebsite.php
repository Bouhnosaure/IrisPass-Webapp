<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Organization;
use App\Repositories\WebsiteRepositoryInterface;
use App\Services\FlatCmService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

class CreateWebsite extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var
     */
    private $organization_id;
    /**
     * @var
     */
    private $identifier;
    /**
     * @var
     */
    private $username;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $password;

    /**
     * Create a new job instance.
     *
     * @param $organization_id
     * @param $identifier
     * @param $username
     * @param $email
     * @param $password
     */
    public function __construct($organization_id, $identifier, $username, $email, $password)
    {

        $this->organization_id = $organization_id;
        $this->identifier = $identifier;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @param FlatCmService $service
     * @param WebsiteRepositoryInterface $websiteRepository
     */
    public function handle(FlatCmService $service, WebsiteRepositoryInterface $websiteRepository)
    {
        if ($service->process($this->identifier, $this->username, $this->email, $this->password)) {

            $website = $websiteRepository->create([
                'identifier' => $this->identifier,
                'username' => $this->username,
                'email' => $this->email,
                'is_active' => true,
                'url' => 'http://' . $this->identifier . '.' . env('CMS_BASE_URL')
            ]);

            $organization = Organization::findOrFail($this->organization_id);

            $website->organization()->associate($organization);
            $website->save();

            //fire event

        } else {

            //fire event

        }
    }
}
