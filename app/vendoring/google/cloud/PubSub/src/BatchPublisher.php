<?php
/**
 * Copyright 2017 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\PubSub;

use Google\Cloud\Core\Batch\BatchRunner;
use Google\Cloud\Core\Batch\BatchTrait;

/**
 * Publishes messages to Google Cloud Pub\Sub with background batching.
 *
 * Example:
 * ```
 * use Google\Cloud\PubSub\PubSubClient;
 *
 * $pubsub = new PubSubClient();
 * $batchPublisher = $pubsub->topic('my_topic')
 *     ->batchPublisher();
 *
 * $batchPublisher->publish([
 *     'data' => 'An important message.'
 * ]);
 * ```
 *
 * @experimental The experimental flag means that while we believe this method
 *      or class is ready for use, it may change before release in backwards-
 *      incompatible ways. Please use with caution, and test thoroughly when
 *      upgrading.
 */
class BatchPublisher
{
    use BatchTrait;

    const ID_TEMPLATE = 'pubsub-topic-%s';

    /**
     * @var array
     */
    private static $topics = [];

    /**
     * @var string
     */
    private $topicName;

    /**
     * @param string $topicName The topic name.
     * @param array $options [optional] Please see
     *        {@see Google\Cloud\PubSub\Topic::batchPublisher()} for
     *        configuration details.
     */
    public function __construct($topicName, array $options = [])
    {
        $this->topicName = $topicName;
        $this->setCommonBatchProperties($options + [
            'identifier' => sprintf(self::ID_TEMPLATE, $topicName),
            'batchMethod' => 'publishBatch'
        ]);
    }

    /**
     * Send messages to a batch queue.
     *
     * Example:
     * ```
     * $batchPublisher->publish([
     *     'data' => 'An important message.'
     * ]);
     * ```
     *
     * @param array $message [Message Format](https://cloud.google.com/pubsub/docs/reference/rest/v1/PubsubMessage).
     * @return bool
     */
    public function publish(array $message)
    {
        return $this->batchRunner->submitItem($this->identifier, $message);
    }

    /**
     * Returns an array representation of a callback which will be used to write
     * batch items.
     *
     * @return array
     */
    protected function getCallback()
    {
        if (!array_key_exists($this->topicName, self::$topics)) {
            $client = new PubSubClient($this->getUnwrappedClientConfig());
            self::$topics[$this->topicName] = $client->topic($this->topicName);
        }

        return [self::$topics[$this->topicName], $this->batchMethod];
    }
}
