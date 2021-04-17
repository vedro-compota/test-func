<?php

/**
 * Символы-разделите слов
 */
define("WORD_SEPARATORS",
    [
        '\s',
        ',',
        '，', // 'китайская' запятая (мультибайтный символ)
    ]
);

/**
 * Символы, которые рассматриваются как знаки препинания
 */
define("PUNCTUATION_SYMBOLS",
    [
        '!',
        ',',
        '?',
        ';',
        ':',
        '.',
        '。', // 'китайская' точка (мультибайтный символ)
    ]
);

/**
 * Найдет самые популярные слова в переданной строке
 * 
 * в этой версии:
 * -- слова написанные в разном регистре считаются разными
 * -- в китайском нет как таковых пробелов, но могут использоваться точки и разделители, 
 * поэтому будем считать словами то, что между этими разделителями (на этом примере
 * покажем работу с мультибайтными символами).
 * 
 * @param string $source  исходный текст
 * @param int $count      число популярных слов в итоговом массиве
 * @return array
 */
function getPopularWords(string $source, int $count = 5): array
{
    $result = [];
    $fragms = mb_split("[" . implode('', WORD_SEPARATORS) . "]+", $source);

    foreach ($fragms as $value) {
        $key = trim(mb_ereg_replace("["
            . implode('', PUNCTUATION_SYMBOLS) . "]+", "", $value));

        if (($key !== '')) {
            if (!empty($result[$key])) {
                $result[$key]++;
            } else {
                $result[$key] = 1;
            }
        }
    }
    arsort($result);

    $result = array_slice($result, 0, $count, true);
    return $result;
}
