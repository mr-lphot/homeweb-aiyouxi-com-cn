<?php

namespace App\Render;

class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $imageUrl;
    private array $tags;
    private array $metrics;

    public function __construct(
        string $url = '',
        string $title = '',
        string $description = '',
        string $imageUrl = '',
        array $tags = [],
        array $metrics = []
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->tags = $tags;
        $this->metrics = $metrics;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    public function setMetrics(array $metrics): self
    {
        $this->metrics = $metrics;
        return $this;
    }

    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImage = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $tagHtml = '';
        if (!empty($this->tags)) {
            $tagParts = [];
            foreach ($this->tags as $tag) {
                $escapedTag = htmlspecialchars($tag, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $tagParts[] = '<span class="link-card-tag">' . $escapedTag . '</span>';
            }
            $tagHtml = '<div class="link-card-tags">' . implode('', $tagParts) . '</div>';
        }

        $metricHtml = '';
        if (!empty($this->metrics)) {
            $metricParts = [];
            foreach ($this->metrics as $key => $value) {
                $escapedKey = htmlspecialchars($key, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $escapedVal = htmlspecialchars((string)$value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $metricParts[] = '<span class="link-card-metric"><strong>' . $escapedKey . ':</strong> ' . $escapedVal . '</span>';
            }
            $metricHtml = '<div class="link-card-metrics">' . implode(' ', $metricParts) . '</div>';
        }

        $imageHtml = '';
        if ($this->imageUrl !== '') {
            $imageHtml = '<div class="link-card-image"><img src="' . $escapedImage . '" alt="' . $escapedTitle . '"></div>';
        }

        return '<div class="link-card">'
            . $imageHtml
            . '<div class="link-card-content">'
            . '<a href="' . $escapedUrl . '" class="link-card-title" target="_blank" rel="noopener noreferrer">' . $escapedTitle . '</a>'
            . '<p class="link-card-description">' . $escapedDesc . '</p>'
            . $tagHtml
            . $metricHtml
            . '</div>'
            . '</div>';
    }

    public static function createDefaultCard(): self
    {
        return new self(
            url: 'https://homeweb-aiyouxi.com.cn',
            title: '爱游戏 - 精彩游戏世界',
            description: '探索爱游戏平台，发现海量热门游戏，享受极致娱乐体验。',
            imageUrl: 'https://homeweb-aiyouxi.com.cn/images/og-image.jpg',
            tags: ['游戏', '娱乐', '热门推荐'],
            metrics: ['用户评分' => 4.8, '在线人数' => '12,000+']
        );
    }
}