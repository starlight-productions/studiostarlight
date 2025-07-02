<?php
namespace App\Models;

class Post
{
    /** Endpoint list (feel free to add more) */
    private const FEEDS = [
        'bsquared'   => 'https://studiostarlight.art/wp-json/wp/v2/posts?author=2_embed&per_page=5',
        'doublestar' => 'https://studiostarlight.art/wp-json/wp/v2/posts?author=3_embed&per_page=5',
    ];

    /** Fetch latest posts from all feeds, merge, sort by date */
    public static function latest(int $limit = 10): array
    {
        $all = [];
        foreach (self::FEEDS as $author => $url) {
            $json = @file_get_contents($url);
            if (!$json) continue;                                // skip on error
            $posts = json_decode($json, true) ?: [];
            foreach ($posts as $p) {
                $all[] = [
                    'id'        => $p['id'],
                    'title'     => html_entity_decode($p['title']['rendered']),
                    'excerpt'   => strip_tags($p['excerpt']['rendered']),
                    'link'      => $p['link'],
                    'date'      => $p['date_gmt'] ?? $p['date'],
                    'author'    => $author,
                    'image'     => $p['_embedded']['wp:featuredmedia'][0]['source_url'] ?? null,
                ];
            }
        }
        // sort by newest
        usort($all, fn($a, $b) => strtotime($b['date']) <=> strtotime($a['date']));
        return array_slice($all, 0, $limit);
    }
}
