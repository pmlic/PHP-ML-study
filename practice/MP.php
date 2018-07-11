<?php

use pf\arr\PFarr;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer;

require_once 'vendor/autoload.php';
$samples = [
    'Lorem ipsum dolor sit amet dolor',
    'Mauris placerat ipsum dolor',
    'Mauris diam eros fringilla diam',
];

$vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
$vectorizer->transform($samples);
$data = $vectorizer->getVocabulary();
PFarr::dd($data);