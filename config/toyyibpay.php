<?php

return [

  'client_secret' => env('TOYYIBPAY_USER_SECRET_KEY', ''),
  'redirect_uri' => env('TOYYIBPAY_REDIRECT_URI', ''),
  'sandbox' => env('TOYYIBPAY_SANDBOX', true),
  'categoryCode' => env('TOYYIBPAY_CATEGORY_CODE', '')
];
