<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Skill;
use App\Models\SkillUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    protected $user;
    protected $skill;
    protected $skillUser;

    public function __construct(User $user, Skill $skill, SkillUser $skillUser)
    {
        $this->user = $user;
        $this->skill = $skill;
        $this->skillUser = $skillUser;
    }

    public function index()
    {
        $users = $this->user->all();

        return response()->json($users);
    }

    public function store(StoreRequest $request)
    {
        $user = $this->user->create($request->data());

        $skills = explode(',', $request->get('skills'));

        if ($skills) {
            foreach ($skills as $skill) {
                $this->checkSkills($user->id, $skill);
            }
        }

        return response()->json([
            "success" => true,
            "message" => "User created.",
        ]);
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->data());

        $skills = explode(',', $request->get('skills'));

        if ($skills) {
            $this->skillUser->where('user_id', $user->id)->delete();
            foreach ($skills as $skill) {
                $this->checkSkills($user->id, $skill);
            }
        }

        return response()->json([
            "success" => true,
            "message" => "User updated.",
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        $user->skills()->sync([]);

        return response()->json([
            "success" => true,
            "message" => "User deleted.",
        ]);
    }

    public function checkSkills($userId, $incomingSkill)
    {
        $existingSkill = $this->skill->where('skill', $incomingSkill)->first();

        if (!$existingSkill) $skill = $this->skill->create(['skill' => $incomingSkill]);

        return $this->createSkillUser($userId, $existingSkill ? $existingSkill->id : $skill->id);
    }

    public function createSkillUser($userId, $skillId)
    {
        $this->skillUser->create([
            'user_id' => $userId,
            'skill_id' => $skillId,
        ]);
    }
}