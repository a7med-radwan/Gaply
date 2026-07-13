<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Promptable;
use Stringable;

class InterviewQuestionsAgent implements Agent, HasStructuredOutput
{
    use Promptable;

    public function __construct(private readonly string $skillName, private readonly string $targetJob) {}

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
     * Instructions for generating interview questions.
     */
    public function instructions(): Stringable|string
    {
        return "You are an expert technical interviewer hiring for a {$this->targetJob} role.
Your task is to generate 5 typical technical interview questions and their model answers for a candidate regarding the skill: **{$this->skillName}**.

The questions should:
1. Cover different difficulty levels (conceptual, practical scenario, troubleshooting).
2. Be highly relevant to a {$this->targetJob} role.
3. Include clean, concise, and technically accurate model answers.";
    }

    /**
     * Define schema for structured output.
     *
     * @return array<string, mixed>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'questions' => $schema->array()->items(
                $schema->object([
                    'question' => $schema->string()->required()->description('The interview question'),
                    'answer' => $schema->string()->required()->description('The model answer / explanation'),
                    'difficulty' => $schema->string()->required()->description('Difficulty level: Easy, Medium, or Hard'),
                ])
            )->required()->description('List of interview questions and answers'),
        ];
    }
}
