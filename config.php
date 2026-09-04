<?php
return [
  'site_name' => 'EuroToll',
  'discount_percent' => 15,
  'service_fee' => 0.00,
  'payment' => [
    'url' => 'https://example.com/',
    'amount_param' => 'amount',
    'currency_param' => 'currency',
    'order_param' => 'order'
  ],
  'orders_file' => __DIR__ . '/storage/orders.json'
];
