<?php

use App\Models\Policy;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PolicyTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test to create policy.
     *
     * @return void
     */
    public function testPolicyCanBeCreated()
    {
        $policy = factory(App\Models\Policy::class)->create([
            'title' => 'Administrator',
        ]);

        $this->assertEquals($policy->title, 'Administrator');

        $this->seeInDatabase('policies', ['id' => '1', 'title' => 'Administrator']);
    }

    public function testPolicyCanBeDeleted()
    {
        $policy = Policy::create(['title' => 'Administrator']);

        $policy->delete();

        $this->NotSeeInDatabase('policies', ['id' => '1', 'title' => 'Administrator']);
    }

    public function testPolicyCanBeAssignedToUser()
    {
        Policy::create(['title' => 'Administrator']);

        $user = factory(User::class)->create([
            'policy_id' => 1,
        ]);

        $this->assertEquals($user->policy_id, 1);

        $founded_user = User::find(1);

        $this->assertEquals($founded_user->policy_id, 1);
    }
}
