<?php

namespace Litecms\Chatbox\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the package.
     *
     * @var array
     */
    protected $policies = [
        \Litecms\Chatbox\Models\Chatbox::class => \Litecms\Chatbox\Policies\ChatboxPolicy::class,
    ];

    /**
     * Register any package authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
    }
}
