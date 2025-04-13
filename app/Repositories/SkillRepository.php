<?php

namespace App\Repositories;

use App\Models\Constants\StatusConstants;
use App\Models\Skill;
use App\Repositories\BaseRepository;

class SkillRepository extends BaseRepository
{
    public function getModel()
    {
        return new Skill();
    }

    /**
     *********************************
     * Method use to get all jobs
     * -------------------------------
     * @return data
     *********************************
     */
    public function getAllSkills()
    {
        return $this->getModel()->where('status', StatusConstants::ACTIVE)->orderByDesc('id')->get();
    }

    /**
     * *****************************
     * method use to add skill sets
     * -----------------------------
     * @param object $request
     * @return data
     * *****************************
     */
    public function addSkill($request)
    {
        $skill = $this->getModel();
        $skill->name = $request->name;
        $skill->created_by = auth()->user()->id;
        $skill->save();
        return $skill;
    }
}
