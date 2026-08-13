<?php
use App\Helpers\RabbitMQHelper;

$workspaceId = 523;

RabbitMQHelper::publishBalanceCheck($workspaceId);

