<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
			// App\Models\Article::factory(4)->create(['user_id' => 5]);

			$startingDate = $this->faker->dateTimeBetween('yesterday', '+6 days');
			// Random datetime of the current week *after* `$startingDate`
			$endingDate = $this->faker->dateTimeBetween($startingDate, strtotime('+6 days'));

			$locations =   [
				'Alabama (AL)',
				'Alaska (AK)',
				'American Samoa (AS)',
				'Arizona (AZ)',
				'Arkansas (AR)',
				'California (CA)',
				'Colorado (CO)',
				'Connecticut (CT)',
				'Delaware (DE)',
				'District of Columbia (DC)',
				'States of Micronesia (FM)',
				'Florida (FL)',
				'Georgia (GA)',
				'Guam (GU)',
				'Hawaii (HI)',
				'Idaho (ID)',
				'Illinois (IL)',
				'Indiana (IN)',
				'Iowa (IA)',
				'Kansas (KS)',
				'Kentucky (KY)',
				'Louisiana (LA)',
				'Maine (ME)',
				'Marshall Islands (MH)',
				'Maryland (MD)',
				'Massachusetts (MA)',
				'Michigan (MI)',
				'Minnesota (MN)',
				'Mississippi (MS)',
				'Missouri (MO)',
				'Montana (MT)',
				'Nebraska (NE)',
				'Nevada (NV)',
				'New Hampshire (NH)',
				'New Jersey (NJ)',
				'New Mexico (NM)',
				'New York (NY)',
				'North Carolina (NC)',
				'North Dakota (ND)',
				'Northern Mariana Islands (MP)',
				'Ohio (OH)',
				'Oklahoma (OK)',
				'Oregan (OR)',
				'Palau (PW)',
				'Pennsilvania (PA)',
				'Puerto Rico (PR)',
				'Rhode Island (RI)',
				'South Carolina (SC)',
				'South Dakota (SD)',
				'Tennessee (TN)',
				'Texas (TX)',
				'Utah (UT)',
				'Vermont (VT)',
				'Virgin Islands (VI)',
				'Virginia (VA)',
				'Washington (WA)',
				'West Virginia (WV)',
				'Wisconsin (WI)',
				'Wyoming (WY)'
			];

			return [
				'start_date'=>$startingDate,
				'end_date'=>$endingDate,
				'location' => $locations[array_rand($locations, 1)],
				'time' => $this->faker->time(),
				'description' => $this->faker->paragraph(),
				'title' => $this->faker->sentence(),
				'user_id' => \App\Models\User::factory(),
				'file_path' => '16124159876o95l97mH6.pdf'
			];
  }
}
