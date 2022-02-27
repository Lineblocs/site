<?php

// Telnyx singleton
require(dirname(__FILE__) . '/lib/Telnyx.php');

// Utilities
require(dirname(__FILE__) . '/lib/Util/AutoPagingIterator.php');
require(dirname(__FILE__) . '/lib/Util/CaseInsensitiveArray.php');
require(dirname(__FILE__) . '/lib/Util/LoggerInterface.php');
require(dirname(__FILE__) . '/lib/Util/DefaultLogger.php');
require(dirname(__FILE__) . '/lib/Util/RandomGenerator.php');
require(dirname(__FILE__) . '/lib/Util/RequestOptions.php');
require(dirname(__FILE__) . '/lib/Util/Set.php');
require(dirname(__FILE__) . '/lib/Util/Util.php');

// HttpClient
require(dirname(__FILE__) . '/lib/HttpClient/ClientInterface.php');
require(dirname(__FILE__) . '/lib/HttpClient/CurlClient.php');

// Errors
require(dirname(__FILE__) . '/lib/Error/Base.php');
require(dirname(__FILE__) . '/lib/Error/Api.php');
require(dirname(__FILE__) . '/lib/Error/ApiConnection.php');
require(dirname(__FILE__) . '/lib/Error/Authentication.php');
require(dirname(__FILE__) . '/lib/Error/Idempotency.php');
require(dirname(__FILE__) . '/lib/Error/InvalidRequest.php');
require(dirname(__FILE__) . '/lib/Error/Permission.php');
require(dirname(__FILE__) . '/lib/Error/RateLimit.php');
require(dirname(__FILE__) . '/lib/Error/SignatureVerification.php');

// API operations
require(dirname(__FILE__) . '/lib/ApiOperations/All.php');
require(dirname(__FILE__) . '/lib/ApiOperations/Create.php');
require(dirname(__FILE__) . '/lib/ApiOperations/Delete.php');
require(dirname(__FILE__) . '/lib/ApiOperations/NestedResource.php');
require(dirname(__FILE__) . '/lib/ApiOperations/Request.php');
require(dirname(__FILE__) . '/lib/ApiOperations/Retrieve.php');
require(dirname(__FILE__) . '/lib/ApiOperations/Update.php');

// Plumbing
require(dirname(__FILE__) . '/lib/ApiResponse.php');
require(dirname(__FILE__) . '/lib/RequestTelemetry.php');
require(dirname(__FILE__) . '/lib/TelnyxObject.php');
require(dirname(__FILE__) . '/lib/ApiRequestor.php');
require(dirname(__FILE__) . '/lib/ApiResource.php');
require(dirname(__FILE__) . '/lib/SingletonApiResource.php');

// Telnyx API: Numbers
require(dirname(__FILE__) . '/lib/AvailablePhoneNumber.php');
require(dirname(__FILE__) . '/lib/NumberOrder.php');
require(dirname(__FILE__) . '/lib/NumberReservation.php');

// Telnyx API: Messaging
require(dirname(__FILE__) . '/lib/Message.php');
require(dirname(__FILE__) . '/lib/MessagingProfile.php');
require(dirname(__FILE__) . '/lib/MessagingPhoneNumber.php');
require(dirname(__FILE__) . '/lib/MessagingSenderID.php');
require(dirname(__FILE__) . '/lib/MessagingShortCode.php');

// Old resources
require(dirname(__FILE__) . '/lib/Collection.php');