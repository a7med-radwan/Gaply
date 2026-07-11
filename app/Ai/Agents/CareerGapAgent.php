<?php

namespace App\Ai\Agents;

use App\Models\User;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Stringable;

class CareerGapAgent implements Agent, HasStructuredOutput
{
    use Promptable;

    public function __construct(private readonly User $user) {}

    /**
     * Use OpenRouter as primary provider, Groq as fallback.
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
     * System instructions for the career gap analysis agent.
     */
    public function instructions(): Stringable|string
    {
        $skills = $this->user->skills->pluck('name')->join(', ');
        $experience = $this->user->experience ?? 'Not provided';
        $targetJob = $this->user->target_job ?? 'Not specified';

        return <<<PROMPT
        You are an expert career advisor and job market analyst.

        Your task is to perform a comprehensive gap analysis for a candidate who wants to become a: **{$targetJob}**

        ## Candidate Profile
        - **Name**: {$this->user->name}
        - **Target Job**: {$targetJob}
        - **Current Experience**: {$experience}
        - **Current Skills**: {$skills}

        ## Your Analysis Task
        1. **Market Requirements**: List the top 10-15 skills/competencies that employers in {$targetJob} roles typically require in today's job market.
        2. **Missing Skills**: Identify which required skills the candidate currently lacks or needs to improve significantly.
        3. **Gap Summary**: Write a clear, honest, and motivating 2-3 paragraph summary of the gap between the candidate's current state and the target role.
        4. **Readiness Score**: Rate the candidate's current readiness from 0 to 100 based on skill match.
        5. **Improvement Plan**: Create a detailed, actionable week-by-week improvement plan (3-6 months) that covers:
           - Specific resources to learn (courses, books, projects)
           - Milestones and checkpoints
           - Portfolio/project suggestions
           - Networking and job search tips

        Be specific, practical, and encouraging. The plan should be realistic and achievable.
        PROMPT;
    }

    /**
     * Define the structured output schema.
     *
     * @return array<string, mixed>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'missing_skills' => $schema->array()->items($schema->string()->description('A specific skill or technology the candidate needs to learn'))->required()->description('List of skills the candidate is missing for the target job'),
            'market_requirements' => $schema->array()->items($schema->string()->description('A required skill or competency'))->required()->description('Top skills required by the job market for this role'),
            'readiness_score' => $schema->integer()->required()->description('Candidate readiness score from 0 to 100'),
            'gap_summary' => $schema->string()->required()->description('Clear 2-3 paragraph summary of the skills gap'),
            'improvement_plan' => $schema->string()->required()->description('Detailed week-by-week improvement plan in markdown format with specific resources, milestones, and action items'),
        ];
    }
}
