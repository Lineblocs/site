<?php

namespace Intergo\SmsTo\Module\Webhook;

use Intergo\SmsTo\Exceptions\SMStoSignatureVerificationException;

class Signature
{

    /**
     * Verifies the signature header sent by SMS.to. Throws an
     * Intergo\SmsTo\Exceptions\SMStoSignatureVerificationException exception if the verification fails
     *
     * @param string $payload the payload sent by SMSto
     * @param string $smsToHeader the X-SMSTo-Signature Header from SMSTo
     * @param string $secret secret used to generate the signature
     *
     * @return bool
     * @throws SMStoSignatureVerificationException if the verification fails
     */
    public static function verifySignature(string $payload, string $smsToHeader , string $secret)
    {
        // Extract timestamp and signatures from header
        $timestamp = self::getTimestamp($smsToHeader);
        $signature = self::getSignature($smsToHeader);
        if (-1 === $timestamp) {
            throw new SMStoSignatureVerificationException(
                'Unable to extract timestamp from header',
                400
            );
        }
        if (empty($signature)) {
            throw new SMStoSignatureVerificationException(
                'Unable to extract signature from header',
                400
            );
        }

        // Check if expected signature is found in list of signatures from
        // header
        $signedPayload = "{$payload}.{$timestamp}";
        $expectedSignature = self::generateSignature($signedPayload, $secret);

        //compare signatures
        $isSignatureLegit = false;
        if(self::compareSignatures($signature, $expectedSignature)){
            $isSignatureLegit = true;
        }

        if (!$isSignatureLegit) {
            throw new SMStoSignatureVerificationException(
                'Signature found is not matching with the expected signature',
                400
            );
        }

        return true;
    }

    /**
     * Extracts the signature from the SMSTo signature header.
     *
     * @param string $header the signature header
     *
     * @return string The signature
     */
    private static function getSignature($header)
    {
        $items = \explode(',', $header);

        foreach ($items as $item) {
            $itemParts = \explode('=', $item, 2);
            if ('s' === $itemParts[0]) {
                if(is_string($itemParts[1])){
                    return $itemParts[1];
                }
                return "";
            }
        }

        return "";
    }

    /**
     * Compare the 2 signatures and see if they match. Use hash_equals if exist.
     * If not do a length comparison
     *
     * @param string $headerSignature the signature extracted from Header
     * @param string $generatedSignature the generated Signature
     *
     * @return bool true if signatures are equal, false otherwise
     */
    private static function compareSignatures($headerSignature, $generatedSignature)
    {
        if (\function_exists('hash_equals')) {
            return \hash_equals($headerSignature, $generatedSignature);
        }
        if (\strlen($headerSignature) !== \strlen($generatedSignature)) {
            return false;
        }

        $result = 0;
        for ($i = 0; $i < \strlen($headerSignature); ++$i) {
            $result |= \ord($headerSignature[$i]) ^ \ord($generatedSignature[$i]);
        }

        return 0 === $result;
    }

    /**
     * Extracts the timestamp from the SMSTo signature header.
     *
     * @param string $header the signature header
     *
     * @return int the timestamp contained in the header, or -1 if no valid
     *  timestamp is found
     */
    private static function getTimestamp($header)
    {
        $items = \explode(',', $header);

        foreach ($items as $item) {
            $itemParts = \explode('=', $item, 2);
            if ('t' === $itemParts[0]) {
                if (!\is_numeric($itemParts[1])) {
                    return -1;
                }

                return (int) ($itemParts[1]);
            }
        }

        return -1;
    }

    /**
     * Generate the signature for a given payload and secret.
     *
     * The current scheme used is HMAC/SHA-256.
     *
     * @param string $payload the payload to sign
     * @param string $secret the secret used to generate the signature
     *
     * @return string the signature as a string
     */
    public static function generateSignature($payload, $secret)
    {
        return \hash_hmac('sha256', $payload, $secret);
    }

}
