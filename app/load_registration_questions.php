<?php

use App\Helpers\RegionDataHelper;
use App\RegistrationQuestionnaire;
use App\RegistrationResponse;


$questions = [
  [
    'question' => 'How many employees work at your company?',
    'type' => 'choice',
    'choices' => [
      '1-5',
      '6-50',
      '51-500',
      '501-1000',
      '1001+'
    ]
  ],
  [
    'question' => 'Can you tell us more about the services and products your company provides?',
    'type' => 'freetext',
  ],
  [
    'question' => 'How do you plan on using our service?',
    'type' => 'freetext',
  ]
];

foreach ($questions as $item) {
  if ($item['type'] == 'choice') {
    $item['choices'] = json_encode($item['choices']);
    $question = RegistrationQuestionnaire::create($item);
  } else if ($item['type'] == 'freetext') {
    $question = RegistrationQuestionnaire::create($item);
  }
}


