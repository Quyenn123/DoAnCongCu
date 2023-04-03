<?php

use App\Controllers\API\V1\Users\LoginController;

$_Routes['api/users/login'] = [LoginController::class, 'store'];