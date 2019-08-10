<?php

namespace Tests\Traits;

trait DatabaseTransactions
{
    /**
     * Handle database transactions.
     */
    public function beginDatabaseTransaction()
    {
        // $this->prepareDb();

        $this->app['db']->beginTransaction();

        $this->beforeApplicationDestroyed(function () {
            $this->app['db']->rollBack();
        });
    }
}
