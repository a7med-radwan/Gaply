<?php

namespace App\Ai\Agents;

use App\Models\User;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;
use Stringable;

class BioOptimizerAgent implements Agent
{
    use Promptable;

    public function __construct(private readonly User $user, private readonly string $rawText) {}

    /**
     * Provider configuration.
     *
     * @return array<string, string>
     */
    public function provider(): array
    {
        return [
            'openrouter' => 'openai/gpt-4o-mini',
            'groq' => 'llama-3.3-70b-versatile',
        ];
    }

    /**
     * Instructions for the bio optimizer agent.
     */
    public function instructions(): Stringable|string
    {
        $skills = $this->user->skills->pluck('name')->join(', ');
        $targetJob = $this->user->target_job ?? 'Not specified';

        return "You are a professional resume writer and career coach.
Your task is to take a draft biography or experience description and optimize it professionally.

## Context
- Candidate: {$this->user->name}
- Target Job: {$targetJob}
- Current Skills: {$skills}

## Instructions:
1. Rewrite the draft text to make it professional, polished, and impactful for recruiters.
2. Use active verbs and professional phrasing.
3. Highlight achievements, skills, and target job alignment.
4. Keep the output concise, clean, and well-structured (use bullet points if appropriate).
5. Output ONLY the optimized bio text. Do NOT add any pleasantries, intro, outro, Markdown headers (like '# Professional Bio'), or explanations.";
    }
}
