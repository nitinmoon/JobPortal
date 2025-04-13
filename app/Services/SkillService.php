<?php

namespace App\Services;

use App\Repositories\SkillRepository;

class SkillService
{
    private $skillRepository;

    public function __construct(
        SkillRepository $skillRepository,
    ) {
        $this->skillRepository = $skillRepository;
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
        return $this->skillRepository->getAllSkills();
    }

    /**
     * *******************************
     * method used to add skill
     * -------------------------------
     * @param request
     * @return data
     * ********************************
     */
    public function addSkill($request)
    {
        return $this->skillRepository->addSkill($request);
    }
}
