<?php

namespace App\Jobs;


use App\Models\Recommendation;
use App\Models\UserData;
use App\Models\State;
use App\Models\City;
use App\Helpers\UtilityHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class RecommendationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach ($this->data as $emapData) {
            if (!is_null($emapData['title_for_recommendation'])) {
                $user = new Recommendation();
                $user->recommendation_type = null;
                $user->title_for_recommendation = $emapData['title_for_recommendation'];
                $user->sub_text_for_recommendation = $emapData['subtext_for_recommendation'];
                $user->recommendation = $emapData['recommendation'];
                $user->tags_for_associated_risk = $emapData['tags_for_associated_risk_separated_by_semi_colons'];
                $user->reasoning = $emapData['reasoning_separated_by_semi_colons'];
                $user->tags_for_age_appropriateness = $emapData['tags_for_age_appropriateness_separated_by_semi_colons'];
                $user->tag_for_frequency = $emapData['tag_for_frequency'];
                $user->tag_if_affiliate = $emapData['tag_if_affiliate'];
                $user->tag_if_resource = $emapData['tag_if_resource'];
                $user->tags_for_visual_grouping = $emapData['tags_for_visual_grouping_separated_by_semi_colons'];
                $user->save();
            }


        }
    }
}
