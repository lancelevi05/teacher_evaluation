<?php

namespace App\Services;

class PerformanceAnalysisService
{
    protected array $positiveLexicon = [
        'clear','clearly','helpful','friendly','excellent','great','good','organized',
        'prepared','patient','engaging','interactive','fair','knowledgeable','inspiring',
        'passionate','professional','approachable','effective','supportive','understandable',
        'amazing','best','love','wonderful','kind','caring','punctual','encouraging',
    ];

    protected array $negativeLexicon = [
        'late','confusing','unclear','unfair','boring','strict','rude','unprepared',
        'slow','disorganized','unapproachable','harsh','biased','unhelpful','difficult',
        'worst','bad','poor','absent','careless','disrespectful','inconsistent','vague',
    ];

    protected array $recommendationBank = [
        'Teaching Skills'     => 'Consider varying instructional methods and using more visual aids to improve clarity.',
        'Knowledge'           => 'Continue deepening subject-matter expertise through further training or certification.',
        'Communication'       => 'Encourage more two-way dialogue and check for understanding frequently.',
        'Professionalism'     => 'Focus on punctuality and consistent, transparent grading.',
        'Classroom Management'=> 'Establish clearer classroom rules and consistent enforcement.',
        'Overall Satisfaction'=> 'Gather more frequent informal feedback to address concerns early.',
    ];

    /**
     * Analyze a single comment string.
     * Returns ['sentiment' => 'positive|neutral|negative', 'keywords' => [...], 'score' => int, 'confidence' => float]
     */
    public function analyzeComment(?string $text): array
    {
        $text = strtolower($text ?? '');
        $words = preg_split('/[^a-z]+/', $text, -1, PREG_SPLIT_NO_EMPTY);

        $posHits = array_values(array_intersect($words, $this->positiveLexicon));
        $negHits = array_values(array_intersect($words, $this->negativeLexicon));

        $score = count($posHits) - count($negHits);

        $sentiment = match (true) {
            $score > 0 => 'positive',
            $score < 0 => 'negative',
            default    => 'neutral',
        };

        $keywords = array_slice(array_unique(array_merge($posHits, $negHits)), 0, 8);

        $confidence = count($words) > 0
            ? min(1, (count($posHits) + count($negHits)) / max(3, count($words)) * 2 + 0.4)
            : 0.4;

        return [
            'sentiment'  => $sentiment,
            'keywords'   => $keywords,
            'score'      => $score,
            'confidence' => round($confidence, 2),
        ];
    }

    /**
     * Build a full performance summary for a teacher based on aggregated ratings
     * per question-category and a list of comments.
     *
     * @param array $categoryAverages ['Teaching Skills' => 4.2, 'Communication' => 3.1, ...]
     * @param array $comments array of comment strings
     */
    public function buildPerformanceSummary(array $categoryAverages, array $comments = []): array
    {
        $strengths = [];
        $weaknesses = [];

        foreach ($categoryAverages as $category => $avg) {
            if ($avg === null) continue;
            if ($avg >= 4.0) {
                $strengths[] = $category;
            } elseif ($avg < 3.0) {
                $weaknesses[] = $category;
            }
        }

        $allKeywords = [];
        $posCount = 0;
        $negCount = 0;
        $neutralCount = 0;

        foreach ($comments as $c) {
            if (trim((string) $c) === '') continue;

            $res = $this->analyzeComment($c);
            $allKeywords = array_merge($allKeywords, $res['keywords']);

            match ($res['sentiment']) {
                'positive' => $posCount++,
                'negative' => $negCount++,
                default    => $neutralCount++,
            };
        }

        $keywordFreq = array_count_values($allKeywords);
        arsort($keywordFreq);
        $topKeywords = array_slice(array_keys($keywordFreq), 0, 10);

        $validAverages = array_filter($categoryAverages, fn ($v) => $v !== null);
        $overallAvg = count($validAverages)
            ? array_sum($validAverages) / count($validAverages)
            : null;

        return [
            'overall_rating'   => $overallAvg,
            'overall_label'    => $this->ratingLabel($overallAvg),
            'strengths'        => $strengths,
            'weaknesses'       => $weaknesses,
            'keywords'         => $topKeywords,
            'sentiment_counts' => [
                'positive' => $posCount,
                'negative' => $negCount,
                'neutral'  => $neutralCount,
            ],
            'recommendations'  => $this->generateRecommendations($weaknesses, $negCount, $posCount),
        ];
    }

    protected function generateRecommendations(array $weaknesses, int $negCount, int $posCount): array
    {
        $recs = [];

        foreach ($weaknesses as $w) {
            if (isset($this->recommendationBank[$w])) {
                $recs[] = $this->recommendationBank[$w];
            }
        }

        if ($negCount > $posCount && $negCount > 0) {
            $recs[] = 'Overall comment sentiment is trending negative — a short check-in with a department head is advised.';
        }

        if (empty($recs)) {
            $recs[] = 'Performance is strong across categories. Recommend for teaching excellence recognition.';
        }

        return $recs;
    }

    public function ratingLabel(?float $rating): string
    {
        if ($rating === null) return 'No Data';
        if ($rating >= 4.5) return 'Excellent';
        if ($rating >= 3.5) return 'Very Good';
        if ($rating >= 2.5) return 'Good';
        if ($rating >= 1.5) return 'Fair';
        return 'Poor';
    }

    

public function ratingBadgeClass(?float $rating): string
{
    if ($rating === null) return 'performance-nodata';
    if ($rating >= 4.5) return 'performance-excellent';
    if ($rating >= 3.5) return 'performance-good';
    if ($rating >= 2.5) return 'performance-average';
    return 'performance-poor';
}
}