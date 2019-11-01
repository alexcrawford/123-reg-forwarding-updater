<?php

namespace Tests\Browser;

use App\Domain;
use Facebook\WebDriver\Exception\TimeOutException;
use Illuminate\Config\Repository;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class DomainUpdaterTest extends DuskTestCase
{
    private $timeout = 30;

    /**
     * A Dusk test example.
     *
     * @return void
     * @throws Throwable
     */
    public function testUpdateDomains()
    {
        $this->browse(function (Browser $browser) {
            $this->login($browser);

            foreach (Domain::where('is_updated', false)->get() as $domain) {
                $this->updateNameservers($browser, $domain);
                $this->updateForwarding($browser, $domain);

                $domain->is_updated = true;
                $domain->save();
            }
        });
    }

    /**
     * @param Browser $browser
     * @throws TimeOutException
     */
    private function login(Browser $browser)
    {
        $browser->visit($this->config('login_url'))
                ->waitForText('Log in', $this->timeout)
                ->type('identifier', $this->config('username'))
                ->type('password', $this->config('password'))
                ->press('Log in');

        $browser->waitFor('.ReactModalPortal', $this->timeout)
                ->press('Accept');
    }

    /**
     * @param string $index
     * @return Repository|mixed
     */
    private function config(string $index)
    {
        return config('services.123_reg.' . $index);
    }

    /**
     * @param Browser $browser
     * @param Domain $domain
     * @throws TimeOutException
     */
    private function updateNameservers(Browser $browser, $domain)
    {
        $browser->visit($this->config('nameserver_url') . $domain->name)
                ->waitForText('Nameserver management', $this->timeout);

        $browser->click('#reset')
                ->waitForText('Success! Nameservers successfully updated.', $this->timeout)
                ->assertSee('Success!');
    }

    /**
     * @param Browser $browser
     * @param Domain $domain
     * @throws TimeOutException
     */
    private function updateForwarding(Browser $browser, $domain)
    {
        $browser->visit($this->config('forwarding_url') . $domain->name)
                ->waitForText('Web forwarding', $this->timeout)
                ->click("a[href='#tab-1']")
                ->type('permanent_url', $domain->redirect_to ?? 'https://www.insidethegames.biz')
                ->clickLink('Confirm')
                ->waitForText('Success', $this->timeout)
                ->assertSee('Success');
    }
}
